<?php

namespace App\Repositories\Admin\Song;

use App\Repositories\Admin\BaseRepositoryInterface;

interface SongRepositoryInterface extends BaseRepositoryInterface
{
    //Get all song and author of song
    public function getAllSongWithAuthors();

    // Create new song
    public function createNewSong(array $attributes, array $authorIds);

    // Update existed song
    public function updateSong(int $songId, array $attributes, array $authorIds);

    // Delete song
    public function deleteSong(int $songId);
}
