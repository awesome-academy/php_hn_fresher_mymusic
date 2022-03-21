<?php

namespace App\Repositories\Admin\PLaylist;

use App\Repositories\Admin\BaseRepositoryInterface;

interface PlaylistRepoInterface extends BaseRepositoryInterface
{
    //Add song to playlist
    public function addSongToPlaylist($playlistId, $songId);

    //Remove song to playlist
    public function removeSongFromPlaylist($playlistId, $songId);
}
