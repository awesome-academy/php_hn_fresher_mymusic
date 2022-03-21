<?php

namespace App\Http\Controllers\User;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\AccountChangePasswordRequest;
use App\Http\Requests\User\AccountUpdateRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function show()
    {
        return view('user.account.show');
    }

    public function edit()
    {
        return view('user.account.edit');
    }

    public function update(AccountUpdateRequest $request)
    {
        try {
            $data = $request->only([
                'first_name',
                'last_name',
            ]);

            DB::beginTransaction();

            if ($file = $request->file('avatar')) {
                $avatar = Helpers::storeUserAvatar($file);
                $data = array_merge($data, compact('avatar'));
                Helpers::removeUserAvatar(auth()->user()->avatar);
            }

            $this->userRepo->update(auth()->user()->id, $data);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            abort(500);
        }

        return redirect()->route('user.account.show')->with('success', __('update_success'));
    }

    public function changePassword()
    {
        return view('user.account.change-password');
    }

    public function updatePassword(AccountChangePasswordRequest $request)
    {
        $password = $request->input('password_confirmation');
        $this->userRepo->update(auth()->user()->id, [
            'password' => Hash::make($password),
        ]);

        return redirect()->back()->with('success', __('update_success'));
    }
}
