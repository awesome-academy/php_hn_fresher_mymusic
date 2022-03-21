<header class="c-nav">
    <div class="navigate">
        <i class="fa-solid fa-angle-left"></i>
    </div>
    <div class="c-nav-right">
        <div class="lang-dropdown parent-el-dropdown d-flex align-items-center">
            <span class="icon"><i class="fa-solid fa-earth-asia"></i></span>
            <span class="mx-2">{{ __('Language') }}</span>
            <span><i class="fa-solid fa-caret-down"></i></span>
            <div class="lang-list header-dropdown">
                <a href="{{ route('language', ['vi']) }}">{{ __('Vietnamese') }}</a>
                <a href="{{ route('language', ['en']) }}">{{ __('English') }}</a>
            </div>
        </div>
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <div class="user-dropdown parent-el-dropdown ml-3">
                <div class="avatar">
                    <img src="{{ asset(Auth::user()->avatar) }}" alt="avatar">
                </div>
                <div class="username">
                    <span>{{ Auth::user()->full_name }}</span>
                    <span><i class="fa-solid fa-caret-down"></i></span>
                </div>
                <div class="user-dropdown-list header-dropdown">
                    <a href="{{ route('user.account.show') }}">{{ __('Profile') }}<span></span></a>
                    @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}">{{ __('admin_page')}}</span></a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button class="dropdown-item d-flex align-items-center">
                            <i class="bi bi-box-arrow-right"></i>
                            <span> {{ __('Logout') }} </span>
                        </button>
                    </form>
                </div>
            </div>
        @endguest
    </div>

</header>
