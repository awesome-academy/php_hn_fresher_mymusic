<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Playlist\PlaylistRepoInterface;

class PlaylistController extends Controller
{
    protected $playlistRepo;

    public function __construct(PlaylistRepoInterface $playlistRepo)
    {
        $this->playlistRepo = $playlistRepo;
    }

    public function showPlaylists()
    {
        $playlists = $this->playlistRepo->findByWhere([['user_id', auth()->user()->id]]);

        return response()->json(compact('playlists'));
    }

    public function showDetailPlaylist($id)
    {
        $playlist = $this->playlistRepo->find($id);

        return response()->view('user.playlist', compact('playlist'));
    }
}
