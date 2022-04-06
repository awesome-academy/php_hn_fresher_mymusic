<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Helpers
{
    const USER_FILESYSTEM_DRIVER = 'user';
    const STORE_SONG_DRIVER = 'song';
    const DEFAULT_AVATAR_PATH = 'assets/img/default-avatar.png';
    const TEMP_FOLDER = '/tmp-files/';

    public static function storeUserAvatar($file)
    {
        if (!$file) {
            return self::DEFAULT_AVATAR_PATH;
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

    public static function removeUserAvatar($path)
    {
        if (strcmp($path, self::DEFAULT_AVATAR_PATH) == 0) {
            return true;
        }

        $path = str_replace('storage', 'public', $path);

        return Storage::delete($path);
    }

    public static function findNotificationById($id)
    {
        return auth()->user()->Notifications->find($id);
    }

    public static function getAllNotification()
    {
        return auth()->user()->Notifications;
    }

    public static function markAsRead($notification)
    {
        return $notification->markAsRead();
    }

    public static function getLatestNotification()
    {
        return auth()->user()->Notifications->first();
    }

    public static function getFileFromExcel($path)
    {
        $pathParts = pathinfo($path);
        $newPath = $pathParts['dirname'] . self::TEMP_FOLDER;
        if (!is_dir($newPath)) {
            mkdir($newPath);
        }
        $newUrl = $newPath . $pathParts['basename'];
        copy($path, $newUrl);
        $imgInfo = getimagesize($newUrl);

        return new UploadedFile(
            $newUrl,
            $pathParts['basename'],
            $imgInfo['mime'],
            filesize($path),
            true,
            true
        );
    }
}
