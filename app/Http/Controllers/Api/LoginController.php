<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Repositories\User\UserRepoInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepoInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login(LoginRequest $request)
    {
        try {
            $user = $this->userRepo->findByWhere(['email' => $request->email])->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => trans('auth.failed'),
                ], 404);
            }
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ], 200);
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
            ], 500);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => __('Logout'),
        ], 200);
    }
}
