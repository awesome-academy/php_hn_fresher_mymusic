<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    const PIVOT_TABLE_PLAYLIST = 'playlist_song';
    const PIVOT_TABLE_CATEGORY = 'category_song';
    const PIVOT_TABLE_AUTHOR = 'author_song';

    protected $fillable = [
        'name',
        'thumbnail',
        'path',
        'description',
    ];

    public function playLists()
    {
        return $this->belongsToMany(Playlist::class, self::PIVOT_TABLE_PLAYLIST);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, self::PIVOT_TABLE_CATEGORY);
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, self::PIVOT_TABLE_AUTHOR);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
