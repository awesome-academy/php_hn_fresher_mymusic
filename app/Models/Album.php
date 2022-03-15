<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author_id'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return $this->attributes['created_at'] = Carbon::parse($value)
            ->format(config('admin.format.datetime'));
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->attributes['updated_at'] = Carbon::parse($value)
            ->format(config('admin.format.datetime'));
    }
}
