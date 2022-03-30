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

    public function blockUser(int $userId)
    {
        $user = $this->find($userId);

        if ($user->isAdmin()) {
            throw new \Exception(__('Cannot block admin'));
        }

        $user->active = User::USER_UNACTIVE;
        $user->save();

        return true;
    }

    public function unblockUser(int $userId)
    {
        $user = $this->find($userId);
        $user->active = User::USER_ACTIVE;
        $user->save();

        return true;
    }
}
