<?php

namespace App\Repositories\Admin\Album;

use App\Models\Album;
use App\Repositories\Admin\BaseRepository;

class AlbumRepository extends BaseRepository implements AlbumRepoInterface
{
    public function getModel()
    {
        return Album::class;
    }

    public function getAlbumWithSong($id)
    {
        return $this->find($id)->with('songs')->first();
    }

    public function deleteSongOfAlbum($id)
    {
        return $this->find($id)->songs()->delete();
    }
}
