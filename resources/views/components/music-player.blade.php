<div class="music-player">
    <!-- Left -->
    <div class="left-player">
        <div class="music-information-box">
            <div class="music-img">
                <img src="{{ asset('assets/img/logo.svg') }}" alt="">
            </div>
            <div class="music-information">
                <span class="name"></span>
                <small id="author"></small>
                <input id="song-id" type="hidden" value="">
            </div>
        </div>
        <div class="music-action-box">
            <div class="add-to-favorite" title="{{ __('like') }}">
                <span class="fav">
                    <i class="fa-solid fa-heart"></i>
                </span>
            </div>
            <div class="add-to-playlist" title="{{ __('addToPlaylist') }}">
                <span data-toggle="modal" data-target="#add-playlist">
                    <i class="fa-solid fa-plus"></i>
                </span>
            </div>
        </div>
    </div>

    <!-- Center -->
    <div class="center-player">
        <div class="music-controller">
            <div class="item mix-btn" title="{{ __('shuffleSong')}}">
                <span><i class="fa-solid fa-shuffle"></i></span>
            </div>
            <div class="item prev-btn" title="{{ __('prev')}}">
                <span><i class="fa-solid fa-backward-step"></i></span>
            </div>
            <div class="item center-btn" title="{{ __('playPause')}}" onclick="musicPlayer.handleEvents()">
                <span class="play">
                    <i class="fa-solid fa-play"></i>
                </span>
                <span class="pause d-none">
                    <i class="fa-solid fa-pause"></i>
                </span>
            </div>
            <div class="item next-btn" title="{{__('next')}}">
                <span><i class="fa-solid fa-forward-step"></i></span>
            </div>
            <div class="item loop-btn" title="{{__('replay')}}">
                <span><i class="fa-solid fa-rotate"></i></span>
            </div>
        </div>
        <div class="music-range-time">
            <small class="current-time">0:00</small>
            <input type="range" id="range-time-control" class="range-time-control" value="0" min="0" max="1000">
            <small class="total-time">0:00</small>
        </div>
    </div>

    <!-- Right -->
    <div class="right-player">
        <div class="comment-btn" title="{{ __('comments')}}">
            <span><i class="fa-solid fa-comment-dots"></i></span>
        </div>
        <div class="lyric-btn" title="{{__('lyrics')}}">
            <span><i class="fa-solid fa-bars-staggered"></i></span>
        </div>
        <div class="volume-btn" title="{{__('volumn')}}">
            <span class="fire"><i class="fa-solid fa-volume-high"></i></span>
            <span class="mute d-none"><i class="fa-solid fa-volume-xmark"></i></span>
        </div>
        <div class="volume-control">
            <input type="range" id="range-volume-control" class="range-volume-control" value="0.5" min="0" max="1" step="0.1">
        </div>
    </div>
</div>

<x-user-modal x-id="add-playlist" x-title="{{ __('add_to_playlist') }}" x-size="md">
    <form id="add-playlist" method="post">
        @csrf
        <div class="form-group">
            <input type="hidden" value="" name="song_id" id="song-id-select">
            <label for="name">{{ __('playlist_name') }}</label>
            <select name="playlist_id" id="select-playlist" class="form-select" aria-label="" required>
            </select>
        </div>
        <button class="btn-add btn-custom" type="submit"> {{ __('submit')}} </button>
    </form>
 </x-user-modal>
