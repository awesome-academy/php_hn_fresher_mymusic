<?php

namespace App\Repositories\Admin\Playlist;

use App\Models\Playlist;
use App\Repositories\Admin\BaseRepository;

class PlaylistRepository extends BaseRepository implements PlaylistRepoInterface
{
    const FAVORITE_NAME = "favorite";
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

    public function createFavoritePlaylist($userId)
    {
        $data['name'] = self::FAVORITE_NAME;
        $data['user_id'] = $userId;

        return $this->model->create($data);
    }

    public function getAllPlaylistOfUser()
    {
        return $this->findByWhere([
            ['user_id', auth()->user()->id],
            ['name','!=',self::FAVORITE_NAME]
        ]);
    }

    public function getFavoritePlaylist()
    {
        return $this->findByWhere([
            ['user_id', auth()->user()->id],
            ['name',self::FAVORITE_NAME]
        ]);
    }
}
