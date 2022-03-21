<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Admin\BaseRepository;

class UserRepository extends BaseRepository implements UserRepoInterface
{
    public function getModel()
    {
        return User::class;
    }
}
