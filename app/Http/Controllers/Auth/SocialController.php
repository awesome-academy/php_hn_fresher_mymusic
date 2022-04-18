<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\RegisterNotification;
use App\Repositories\Admin\Playlist\PlaylistRepoInterface;
use App\Repositories\User\UserRepoInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use Pusher\Pusher;
use Redirect;
use Socialite;

class SocialController extends Controller
{
    protected $userRepo;
    protected $playlistRepo;

    public function __construct(UserRepoInterface $userRepo, PlaylistRepoInterface $playlistRepo)
    {
        $this->userRepo = $userRepo;
        $this->playlistRepo = $playlistRepo;
    }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $userInfo = Socialite::driver($provider)->user();

        $user = $this->createUser($userInfo, $provider);

        auth()->login($user);

        return redirect()->route('home');
    }

    public function createUser($userInfo, $provider)
    {
        $user = $this->userRepo->findByWhere([['provider_id', $userInfo->id]])->first();
        if (!$user) {
            $userData = [
                'first_name' => $userInfo->user['given_name'],
                'last_name' => $userInfo->user['family_name'],
                'email' => $userInfo->email,
                'avatar' => $userInfo->avatar,
                'provider' => $provider,
                'provider_id' => $userInfo->id,
            ];
            $user = $this->userRepo->create($userData);
            $user->email_verified_at = Carbon::now();
            $user->save();

            $data = [
                'email' => $user->email,
            ];

            $this->sendNotification($data);

            $this->playlistRepo->createFavoritePlaylist($user->id);
        }

        return $user;
    }

    public function sendNotification($data)
    {
        $admins = $this->userRepo->getAllAdminAccounts();
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
    }
}
