<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepoInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepoInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $users = $this->userRepo
            ->getAllWithPaginate(config('admin.paginate.user'));

        return view('admin.users.list', compact('users'));
    }

    public function blockUser($id)
    {
        try {
            $isBlocked = $this->userRepo->blockUser($id);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'block' => $isBlocked,
        ]);
    }

    public function unblockUser($id)
    {
        try {
            $isUnblocked = $this->userRepo->unblockUser($id);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }

        return response()->json([
            'unblock' => $isUnblocked,
        ]);
    }
}
