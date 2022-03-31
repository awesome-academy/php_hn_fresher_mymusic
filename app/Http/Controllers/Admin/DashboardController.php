<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Song\SongRepositoryInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $songRepo;

    public function __construct(SongRepositoryInterface $songRepo)
    {
        $this->songRepo = $songRepo;
    }

    public function statisticalSongsInYear($year)
    {
        $songs = $this->songRepo->statisticalSong($year);

        return response()->json(compact('songs'));
    }

    public function showDashdoardScreen()
    {
        return view('admin.dashboard');
    }
}
