<?php

namespace Tests\Unit\Models;

use App\Models\Song;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class SongTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $song;

    public function setup(): void
    {
        parent::setUp();
        $this->song = new Song();
    }

    public function tearDown(): void
    {
        unset($this->song);
        parent::tearDown();
    }

    public function testPrimaryKey()
    {
        $this->assertEquals('id', $this->song->getKeyName());
    }

    public function testValidFillableProperties()
    {
        $fillable = [
            'name',
            'thumbnail',
            'path',
            'description',
            'durations',
            'album_id',
        ];

        $this->assertEquals($fillable, $this->song->getFillable());
    }

    public function testSongBelongsToManyPlaylists()
    {
        $relation = $this->song->playLists();

        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('song_id', $relation->getForeignPivotKeyName());
    }

    public function testSongBelongsToManyCategories()
    {
        $relation = $this->song->categories();

        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('song_id', $relation->getForeignPivotKeyName());
    }

    public function testSongBelongsToManyAuthors()
    {
        $relation = $this->song->authors();

        $this->assertInstanceOf(BelongsToMany::class, $relation);
        $this->assertEquals('song_id', $relation->getForeignPivotKeyName());
    }

    public function testSongBelongsToAlbum()
    {
        $relation = $this->song->album();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertEquals('album_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getOwnerKeyName());
    }

    public function testSongHasManyComments()
    {
        $relation = $this->song->comments();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('song_id', $relation->getForeignKeyName());
        $this->assertEquals('id', $relation->getLocalKeyName());
    }

    public function testValidTimeSong()
    {
        $this->song->setRawAttributes([
            'durations' => 300,
        ]);

        $this->assertEquals('05:00', $this->song->getAttributeValue('time_song'));
    }
}
