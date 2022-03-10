<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helpers
{
    const USER_FILESYSTEM_DRIVER = 'user';

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
}
