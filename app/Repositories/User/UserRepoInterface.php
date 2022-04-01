<?php

namespace App\Repositories\User;

use App\Repositories\Admin\BaseRepositoryInterface;

interface UserRepoInterface extends BaseRepositoryInterface
{
    // Block user
    public function blockUser(int $userId);

    // Unblock user
    public function unblockUser(int $userId);

    // Get user with role admin
    public function getAllAdminAccounts();

    // Statistical new users for past week
    public function countNewUsersByWeek();
}
