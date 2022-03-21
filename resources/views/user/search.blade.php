<section class="search-container container-fluid">
    <div class="row my-3">
        <div class="col-lg-12 d-flex justify-content-center">
            <form class="form" id="search-form">
                <div class="seach-box">
                    <input type="text" class="form-control c-form-control"
                        placeholder="{{ __('user_search_placeholder') }}">
                    <button class="btn c-btn btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="songs-box row my-3">
        <div class="col-lg-12 mb-2">
            <h4 class="text-light text-capitalize"> {{ __('songs') }} </h4>
        </div>
        <div class="col-lg-12">
            <div class="search-result-box">
                @foreach ($songs as $key => $song)
                    <div class="search-result-item song" style="background-color: {{ $song->rand_color }}"
                        data-song="{{ $song->path }}" data-title="{{ $song->name }}" data-thumbnail="{{ $song->thumbnail }}"
                        data-id="{{ $key }}" data-author="{{ implode(', ', $song->authors->pluck('name')->toArray()) }}">
                        <h5 class="mb-1"> {{ $song->name }} </h5>
                        <small class="d-inline-block px-2">
                            {{ implode(', ', $song->authors->pluck('name')->toArray()) }}
                        </small>
                        <img src="{{ asset($song->thumbnail) }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="albums-box row my-3">
        <div class="col-lg-12 mb-2">
            <h4 class="text-light text-capitalize"> {{ __('albums') }} </h4>
        </div>
        <div class="col-lg-12">
            <div class="search-result-box">
                @foreach ($albums as $key => $album)
                    @if (isset($album->songs) && count($album->songs) > 0)
                        <div class="search-result-item album" style="background-color: {{ $album->rand_color }}" data-id="{{ $album->id }}">
                            <h5 class="mb-1"> {{ $album->title }} </h5>
                            <small class="d-inline-block px-2"> {{ $album->author->name }} </small>
                            <img src="{{ asset($album->songs->first()->thumbnail) }}">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="authors-box row my-3">
        <div class="col-lg-12 mb-2">
            <h4 class="text-light text-capitalize"> {{ __('authors') }} </h4>
        </div>
        <div class="col-lg-12">
            <div class="search-result-box">
                @foreach ($authors as $key => $author)
                    <div class="search-result-item author" style="background-color: {{ $author->rand_color }}" data-id="{{ $author->id }}">
                        <h5> {{ $author->name }} </h5>
                        <img src="{{ asset($author->thumbnail) }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
