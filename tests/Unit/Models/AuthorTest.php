<?php

namespace Tests\Unit\Models;

use App\Models\Author;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    protected $author;

    /**
     * This method is called before each test.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->author = new Author();
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        unset($this->author);
        parent::tearDown();
    }

    /**
     * This method test $fillable property
     */
    public function testValidFillableProperties()
    {
        $fillable = [
            'name',
            'thumbnail',
            'description',
        ];

        $this->assertEquals($fillable, $this->author->getFillable());
    }

    /**
     * This method test primary key
     */
    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->author->getKeyName());
    }

    /**
     * This method test relationship with album model
     */
    public function testAlbumRelation()
    {
        $relation = $this->author->albums();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('author_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    /**
     * This method test relationship with song model
     */
    public function testSongRelation()
    {
        $relation = $this->author->songs();

        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('author_song', $relation->getTable());
        $this->assertEquals('author_song.author_id', $relation->getQualifiedForeignPivotKeyName());
        $this->assertEquals('author_song.song_id', $relation->getQualifiedRelatedPivotKeyName());
    }
}
