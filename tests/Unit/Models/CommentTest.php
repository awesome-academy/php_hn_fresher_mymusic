<?php

namespace Tests\Unit\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Tests\TestCase;

class CommentTest extends TestCase
{
    protected $comment;

    /**
     * This method is called before each test.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->comment = new Comment();
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        unset($this->comment);
        parent::tearDown();
    }

    /**
     * This method test primary key
     */
    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->comment->getKeyName());
    }

    /**
     * This method test $fillable property
     */
    public function testValidFillableProperties()
    {
        $fillable = [
            'content',
            'parent_id',
        ];

        $this->assertEquals($fillable, $this->comment->getFillable());
    }

    /**
     * This method test comment relationship with user
     */
    public function testCommentBelongsToUser()
    {
        $relation = $this->comment->user();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    /**
     * This method test comment relationship with song
     */
    public function testCommentBelongsToSong()
    {
        $relation = $this->comment->song();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('song_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }
}
