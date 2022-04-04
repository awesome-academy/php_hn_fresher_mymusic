<?php

namespace App\Repositories\Admin\Category;

use App\Models\Category;
use App\Repositories\Admin\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function deleteSongsOfCategory(int $categoryId)
    {
        $category = $this->find($categoryId);

        return $category->songs()->delete();
    }

    public function getAllCategoryWithSong()
    {
        return $this->model->with('songs')->get();
    }

    public function addSongToCategory($id, $songId)
    {
        return $this->model->findOrFail($id)->songs()->attach($songId);
    }

    public function removeSongFromCategory($id, $songId)
    {
        return $this->model->findOrFail($id)->songs()->detach($songId);
    }
}
