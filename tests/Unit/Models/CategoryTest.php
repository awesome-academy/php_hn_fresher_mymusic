<?php

namespace Tests\Unit\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    protected $category;

    /**
     * This method is called before each test.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->category = new Category();
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        unset($this->category);
        parent::tearDown();
    }

    /**
     * This method test primary key
     */
    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->category->getKeyName());
    }

    /**
     * This method test $fillable property
     */
    public function testValidFillableProperties()
    {
        $fillable = [
            'name',
            'description',
        ];

        $this->assertEquals($fillable, $this->category->getFillable());
    }

    /**
     * This method test category relationship with songs
     */
    public function testCategoryBelongsToManySongs()
    {
        $relation = $this->category->songs();

        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('category_id', $relation->getForeignPivotKeyName());
    }

    /**
     * This method test created at mutator attribute is valid
     */

    public function testValidCreatedAt()
    {
        $this->category->setRawAttributes([
            'created_at' => "2022-03-22 06:27:29",
        ]);

        $this->assertEquals('22/03/2022 06:27', $this->category->getAttributeValue('created_at'));
    }

    /**
     * This method test updated at mutator attribute is valid
     */

    public function testValidUpdatedAt()
    {
        $this->category->setRawAttributes([
            'updated_at' => "2022-03-22 06:27:29",
        ]);

        $this->assertEquals('22/03/2022 06:27', $this->category->getAttributeValue('updated_at'));
    }
}
