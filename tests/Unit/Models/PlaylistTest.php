<?php

namespace Tests\Unit\Models;

use App\Models\Playlist;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class PlaylistTest extends TestCase
{
    protected $playlist;

    /**
     * This method is called before each test.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->playlist = new Playlist();
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        unset($this->playlist);
        parent::tearDown();
    }

    /**
     * This method test primary key
     */
    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->playlist->getKeyName());
    }

    /**
     * This method test $fillable property
     */
    public function testValidFillableProperties()
    {
        $fillable = [
            'name',
            'user_id',
        ];

        $this->assertEquals($fillable, $this->playlist->getFillable());
    }

    /**
     * This method test playlist relationship with user
     */
    public function testPlaylistBelongsToUser()
    {
        $relation = $this->playlist->user();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('user_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    /**
     * This method test playlist relationship with songs
     */
    public function testPlaylistBelongsToManySongs()
    {
        $relation = $this->playlist->songs();

        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('playlist_id', $relation->getForeignPivotKeyName());
    }

    /**
     * This method test playlist attribute name is "favorite"
     */
    public function testPlaylistNameIsFavorite()
    {
        $this->playlist->setRawAttributes([
            'name' => "favorite",
        ]);

        $this->assertTrue($this->playlist->isFavoritePlaylist());
    }

    /**
     * This method test playlist attribute name is not "favorite"
     */
    public function testPlaylistNameIsNotFavorite()
    {
        $this->playlist->setRawAttributes([
            'name' => "Rock",
        ]);

        $this->assertFalse($this->playlist->isFavoritePlaylist());
    }
}
