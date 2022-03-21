<?php

namespace App\Repositories\Admin\Playlist;

use App\Models\Playlist;
use App\Repositories\Admin\BaseRepository;

class PlaylistRepository extends BaseRepository implements PlaylistRepoInterface
{
    public function getModel()
    {
        return Playlist::class;
    }

    public function addSongToPlaylist($playlistId, $songId)
    {
        return $this->find($playlistId)->songs()->syncWithoutDetaching($songId);
    }

    public function removeSongFromPlaylist($playlistId, $songId)
    {
        return $this->find($playlistId)->songs()->detach($songId);
    }

    public function deletePlaylist($playlistId)
    {
        $playlist = $this->find($playlistId);
        $playlist->songs()->sync([]);
        return $this->delete($playlistId);
    }
}
