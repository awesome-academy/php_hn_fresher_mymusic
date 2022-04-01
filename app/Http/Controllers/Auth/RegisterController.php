<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\RegisterNotification;
use App\Providers\RouteServiceProvider;
use App\Repositories\User\UserRepoInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Pusher\Pusher;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $userRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepoInterface $userRepo)
    {
        $this->middleware('guest');
        $this->userRepo = $userRepo;
    }

    public function showRegistrationForm()
    {
        return view('pages.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'max:32'],
            'password_confirmation' => ['required', 'min:6', 'max:32', 'same:password'],
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'avatar' => ['nullable', 'mimes:png,jpg,jpeg']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create(array_merge($data, ['password' => Hash::make($data['password'])]));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $data = $this->validator($request->except('_token'))->validate();
        $avatar = $request->file('avatar') ?? null;
        $path = Helpers::storeUserAvatar($avatar);
        $data = array_merge($data, ['avatar' => $path]);
        $user = $this->create($data);
        $admins = $this->userRepo->getAllAdminAccounts();
        $data = [
            'email' => $user->email,
        ];

        event(new Registered($user));

        $this->guard()->login($user);

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

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        if (!$this->guard()->user()->email_verified_at) {
            return redirect(route('verification.notice'));
        }
    }
}
