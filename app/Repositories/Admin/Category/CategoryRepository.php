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
}
