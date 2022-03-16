<?php

namespace App\Repositories\Admin\Song;

use App\Repositories\Admin\BaseRepositoryInterface;

interface SongRepositoryInterface extends BaseRepositoryInterface
{
    //Get all song and author of song
    public function getAllSongWithAuthors();
}
