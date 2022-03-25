<?php

namespace Tests\Unit\Models;

use App\Models\Album;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class AlbumTest extends TestCase
{
    protected $album;

    /**
     * This method is called before each test.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->album = new Album();
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        unset($this->album);
        parent::tearDown();
    }

    /**
     * This method test primary key
     */
    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->album->getKeyName());
    }

    /**
     * This method test $fillable attribute
     */
    public function testValidFillableAttribute()
    {
        $fillable = [
            'title',
            'description',
            'author_id',
        ];

        $this->assertEquals($fillable, $this->album->getFillable());
    }

    /**
     * This method test relationship of author
     */
    public function testAuthorRelation()
    {
        $relation = $this->album->author();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('author_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    /**
     * This method test relationship of songs
     */
    public function testSongsRelation()
    {
        $relation = $this->album->songs();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('album_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    /**
     * This method test CREATED_AT attribute
     */
    public function testCreatedAtAtrribute()
    {
        $this->album->setRawAttributes([
            'created_at' => '2022-03-25 09:06:12',
        ]);

        $this->assertEquals('25/03/2022 09:06', $this->album->getAttributeValue('created_at'));
    }

    /**
     * This method test UPDATED_AT attribute
     */
    public function testUpdatedAtAtrribute()
    {
        $this->album->setRawAttributes([
            'updated_at' => '2022-03-25 09:06:12',
        ]);

        $this->assertEquals('25/03/2022 09:06', $this->album->getAttributeValue('updated_at'));
    }
}
