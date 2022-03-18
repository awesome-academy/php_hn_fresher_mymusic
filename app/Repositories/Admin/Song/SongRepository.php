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

    
    public function createNewSong(array $attributes, array $authorIds)
    {
        $song = $this->create($attributes);
        $song->authors()->attach($authorIds);
        $song->album_id = $attributes['album_id'];
        $song->save();

        return $song;
    }

    public function updateSong(int $songId, array $attributes, array $authorIds)
    {
        $song = $this->update($songId, $attributes);
        $song->authors()->sync($authorIds);
        $song->album_id = $attributes['album_id'];
        $song->save();

        return $song;
    }

    public function deleteSong(int $songId)
    {
        $song = $this->find($songId);
        $song->authors()->sync([]);
        $deleted = $this->delete($song->id);

        return $deleted;
    }
}
