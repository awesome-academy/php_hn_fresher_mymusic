<?php

namespace App\Repositories\Admin\Song;

use App\Models\Song;
use App\Repositories\Admin\BaseRepository;

class SongRepository extends BaseRepository implements SongRepositoryInterface
{
    public function getModel()
    {
        return Song::class;
    }

    public function getAllSongWithAuthors()
    {
        return $this->model->with('authors')->get();
    }
}
