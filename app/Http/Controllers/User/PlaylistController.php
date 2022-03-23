<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Playlist\PlaylistRepoInterface;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    protected $playlistRepo;

    public function __construct(PlaylistRepoInterface $playlistRepo)
    {
        $this->playlistRepo = $playlistRepo;
    }

    public function index()
    {
        $playlists = $this->playlistRepo->getAllPlaylistOfUser();

        return response()->json(compact('playlists'));
    }

    public function show($id)
    {
        $playlist = $this->playlistRepo->find($id);

        return response()->view('user.playlist', compact('playlist'));
    }

    public function store(Request $request)
    {
        $data = $request->only(['name']);
        $data['user_id'] = auth()->user()->id;
        $playlist = $this->playlistRepo->create($data);

        return response()->json(compact('playlist'));
    }

    public function destroy($id)
    {
        $playlist = $this->playlistRepo->deletePlaylist($id);

        return response()->json(compact('playlist'));
    }

    public function addSongToPlaylist(Request $request)
    {
        $playlistId = $request->playlist_id;
        $songId = $request->song_id;
        $song = $this->playlistRepo->addSongToPlaylist($playlistId, $songId);

        return response()->json(compact('song'));
    }

    public function removeSongFromPlaylist(Request $request)
    {
        $playlistId = $request->playlist_id;
        $songId = $request->song_id;
        $song = $this->playlistRepo->removeSongFromPlaylist($playlistId, $songId);

        return response()->json(compact('song'));
    }

    public function getFavoritePlaylist()
    {
        $favorite = $this->playlistRepo->getFavoritePlaylist();

        return response()->json(compact('favorite'));
    }
}
