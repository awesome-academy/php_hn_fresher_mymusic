<?php

namespace App\Repositories\Admin\Album;

use App\Repositories\Admin\BaseRepositoryInterface;

interface AlbumRepoInterface extends BaseRepositoryInterface
{
    //Get album and all of song belong to this album by album id
    public function getAlbumWithSong($id);

    //Delete all song of album by album id
    public function deleteSongOfAlbum($id);
}
