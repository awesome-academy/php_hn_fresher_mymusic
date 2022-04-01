<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Song\SongRepositoryInterface;
use Exception;
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
        try {
            $songs = $this->songRepo->statisticalSong($year);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json(compact('songs'));
    }

    public function showDashdoardScreen()
    {
        return view('admin.dashboard');
    }
}
