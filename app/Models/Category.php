<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    const PIVOT_TABLE = 'category_song';

    protected $fillable = [
        'name',
        'description',
    ];

    public function songs()
    {
        return $this->belongsToMany(Song::class, self::PIVOT_TABLE);
    }
}
