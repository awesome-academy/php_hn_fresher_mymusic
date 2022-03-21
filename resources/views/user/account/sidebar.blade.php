<div class="col-2 account-sidebar">
    <div class="d-flex flex-column align-items-center justify-content-center">
        <div class="user-avt">
            <img src="{{ asset(auth()->user()->avatar) }}">
        </div>
        <ul class="menu">
            <li><a class="{{ request()->routeIs('user.account.show') ? 'c-active' : '' }}" href="{{ route('user.account.show') }}"> {{ __('Profile') }} </a></li>
            <li><a class="{{ request()->routeIs('user.account.edit') ? 'c-active' : '' }}" href="{{ route('user.account.edit') }}"> {{ __('Edit profile') }} </a></li>
            <li><a class="{{ request()->routeIs('user.account.changePassword') ? 'c-active' : '' }}" href="{{ route('user.account.changePassword') }}"> {{ __('Change password') }} </a></li>
        </ul>
    </div>
</div>
