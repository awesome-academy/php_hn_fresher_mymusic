<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    const PIVOT_TABLE = 'author_song';

    protected $fillable = [
        'name',
        'thumbnail',
        'description',
    ];

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

    public function songs()
    {
        return $this->belongsToMany(Song::class, self::PIVOT_TABLE);
    }
}
