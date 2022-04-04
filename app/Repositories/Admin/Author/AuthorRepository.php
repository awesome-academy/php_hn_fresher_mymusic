<?php

namespace App\Repositories\Admin\Author;

use App\Models\Author;
use App\Repositories\Admin\BaseRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class AuthorRepository extends BaseRepository implements AuthorRepoInterface
{
    const AUTHOR_FILESYSTEM_DRIVER = 'author';

    public function getModel()
    {
        return Author::class;
    }

    public function getAuthorWithSongAndAlbum($id)
    {
        return $this->model->where('id', $id)->with('songs', 'albums')->firstOrFail();
    }

    public function storeAsImageAuthor($file)
    {
        $fileName = $file->getClientOriginalName();
        $fileName = Str::slug(pathinfo($fileName, PATHINFO_FILENAME)) . '-' . Carbon::now()->timestamp;
        $fileExt = $file->getClientOriginalExtension();
        $path = $file->storeAs('thumbnail', $fileName . '.' . $fileExt, self::AUTHOR_FILESYSTEM_DRIVER);

        return 'storage/' . self::AUTHOR_FILESYSTEM_DRIVER . '/' . $path;
    }

    public function deleteSongOfAuthor($id)
    {
        return $this->model->find($id)->songs()->delete();
    }

    public function deleteALbumsOfAuthor($id)
    {
        return $this->model->find($id)->albums()->delete();
    }
}
