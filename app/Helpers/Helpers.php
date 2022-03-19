<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helpers
{
    const USER_FILESYSTEM_DRIVER = 'user';
    const STORE_SONG_DRIVER = 'song';

    public static function storeUserAvatar($file)
    {
        if (!$file) {
            return 'assets/img/default-avatar.png';
        }

        $fileName = $file->getClientOriginalName();
        $fileName = Str::slug(pathinfo($fileName, PATHINFO_FILENAME)) . '-' . Carbon::now()->timestamp;
        $fileExt = $file->getClientOriginalExtension();
        $path = $file->storeAs('avatar', $fileName . '.' . $fileExt, self::USER_FILESYSTEM_DRIVER);

        return 'storage/' . self::USER_FILESYSTEM_DRIVER . '/' . $path;
    }

    public static function storeSongThumbnail($file)
    {
        $fileName = $file->getClientOriginalName();
        $fileName = Str::slug(pathinfo($fileName, PATHINFO_FILENAME)) . '-' . Carbon::now()->timestamp;
        $fileExt = $file->getClientOriginalExtension();
        $path = $file->storeAs('thumbnail', $fileName . '.' . $fileExt, self::STORE_SONG_DRIVER);

        return 'storage/' . self::STORE_SONG_DRIVER . '/' . $path;
    }

    public static function storeSong($file)
    {
        $fileName = $file->getClientOriginalName();
        $fileName = Str::slug(pathinfo($fileName, PATHINFO_FILENAME)) . '-' . Carbon::now()->timestamp;
        $fileExt = $file->getClientOriginalExtension();
        $path = $file->storeAs('source', $fileName . '.' . $fileExt, self::STORE_SONG_DRIVER);

        return 'storage/' . self::STORE_SONG_DRIVER . '/' . $path;
    }

    public static function randomColor()
    {
        $colors = config('search.bgColor');

        return $colors[rand(0, count($colors) - 1)];
    }
}
