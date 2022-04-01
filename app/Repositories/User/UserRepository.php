<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\Admin\BaseRepository;
use Illuminate\Support\Carbon;

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

    public function getAllAdminAccounts()
    {
        return $this->model->active()->admin()->get();
    }

    public function countNewUsersByWeek()
    {
        $now = Carbon::now();
        $subDay = $now->subWeek();
        $users = $this->whereBetween('created_at', [$subDay, $now]);

        return $users->count();
    }
}
