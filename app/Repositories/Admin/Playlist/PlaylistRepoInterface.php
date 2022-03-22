<?php

namespace App\Repositories\Admin\PLaylist;

use App\Repositories\Admin\BaseRepositoryInterface;

interface PlaylistRepoInterface extends BaseRepositoryInterface
{
    //Add song to playlist
    public function addSongToPlaylist($playlistId, $songId);

    //Remove song to playlist
    public function removeSongFromPlaylist($playlistId, $songId);

    //Create favorite playlist for per user
    public function createFavoritePlaylist($userId);

    //Get all playlist of user except favorite playlist
    public function getAllPlaylistOfUser();

    //Get favorite playlist
    public function getFavoritePlaylist();
}
