<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Notifications\RegisterNotification;
use App\Repositories\User\UserRepoInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Pusher\Pusher;

class RegisterController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepoInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        $avatar = $request->file('avatar') ?? null;
        $path = Helpers::storeUserAvatar($avatar);

        $data = array_merge($data, [
            'avatar' => $path,
            'password' => Hash::make($request->input('password')),
        ]);

        $user = $this->userRepo->create($data);
        $user = $this->userRepo->find($user->id);
        $admins = $this->userRepo->getAllAdminAccounts();

        $data = [
            'email' => $user->email,
        ];

        event(new Registered($user));

        auth()->login($user);

        $options = [
            'cluster' => 'ap2',
            'useTLS' => true,
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $pusher->trigger('NotificationEvent', 'send-notification', $data);

        Notification::send($admins, new RegisterNotification($data));

        return response()->json([
            'message' => __('api_sent_mail_success'),
            'user' => $user,
        ]);
    }
}
