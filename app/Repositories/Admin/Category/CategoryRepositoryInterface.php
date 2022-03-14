<?php

namespace App\Repositories\Admin\Category;

use App\Repositories\Admin\BaseRepositoryInterface;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    // Delete all songs of a category
    public function deleteSongsOfCategory(int $categoryId);
}
