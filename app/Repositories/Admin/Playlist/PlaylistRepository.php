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
}
