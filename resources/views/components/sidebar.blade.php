<div class="col-lg-2">
    <div class="right-sidebar">
        <div class="logo">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="my music">
        </div>
        <ul class="menu">
            <li class="menu-item c-active" id="homepage-button">
                <span class="icon"><i class="fa-solid fa-house"></i></span>
                <span class="title">{{ __('Dashboard') }}</span>
            </li>
            <li class="menu-item" id="search-button">
                <span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                <span class="title">{{ __('Search') }}</span>
            </li>
            <li class="menu-item">
                <span class="icon"><i class="fa-solid fa-layer-group"></i></span>
                <span class="title">{{ __('Library') }}</span>
            </li>
        </ul>
        <ul class="menu pt-lg-4 pb-lg-2 c-border-bottom">
            <li class="menu-item">
                <span class="icon"><i class="fa-solid fa-square-plus"></i></span>
                <span class="title" data-toggle="modal" data-target="#create-playlist">
                    {{ __('Create Playlist') }}
                </span>
                <x-user-modal x-id="create-playlist" x-title="{{ __('create_playlist') }}" x-size="md">
                    <form id="create-playlist" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('playlist_name') }}</label>
                            <input name="name" id="name" class="form-control" type="text" placeholder="{{ __('playlist_name') }}" required>
                        </div>
                        <button class="btn-create btn-custom" type="submit"> {{ __('submit')}} </button>
                    </form>
                </x-user-modal>
            </li>
            <li class="favorite menu-item">
                <span class="icon"><i class="fa-solid fa-heart"></i></span>
                <span class="title" data-id="">{{ __('Liked Song') }}</span>
            </li>
        </ul>
        <ul id="sidebar-playlist" class="menu user-playlist mt-lg-2 pb-lg-2">
        </ul>
    </div>
</div>
