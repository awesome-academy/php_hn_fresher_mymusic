<div class="content__middle">
    <div class="artist is-verified">
        <div class="artist__header">
            <div class="artist__info">
                <div class="profile__img">
                    <img src="{{ $author->thumbnail }}" alt="{{ $author->title }}" />
                </div>
                <div class="artist__info__meta">
                    <div class="artist__info__type">{{ __('Author') }}</div>
                    <div class="artist__info__name">{{ $author->name }}</div>
                    <span class="info__amount">{{ $author->songs->count() }} {{ __('songs') }}</span>
                </div>
            </div>
            <div class="artist__navigation">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#artist-overview" aria-controls="artist-overview" role="tab"
                            data-toggle="tab">{{ __('Overview') }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="artist__content">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="artist-overview">
                    <div class="overview">
                        <div class="overview__artist">
                            <div class="section-title">{{ __('author_des') }}</div>
                            <div class="author__about">
                                <div class="artist__info__des">{{ $author->description }}</div>
                            </div>
                            <div class="section-title">{{ __('list_songs') }}</div>
                            <div class="tracks">
                                <table>
                                    <thead>
                                        <tr class="title-table">
                                            <td class="track__number">#</td>
                                            <td>{{ __('song_name') }}</td>
                                            <td>{{ __('album_title') }}</td>
                                            <td><i class="fa-solid fa-clock"></i></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($author->songs as $key => $song)
                                            <tr class="track" data-song="{{ $song->path }}"
                                                data-title="{{ $song->name }}"
                                                data-thumbnail="{{ $song->thumbnail }}" data-id={{ $key }}
                                                data-author="{{ implode(', ', $song->authors->pluck('name')->toArray()) }}">
                                                <td class="track__number">{{ $key + 1 }}</td>
                                                <td class="track__art">
                                                    <img src="{{ asset($song->thumbnail) }}"
                                                        alt="{{ $song->name }}" />
                                                    <div class="track__info">
                                                        <span class="track__title">{{ $song->name }}</span>
                                                        <span
                                                            class="track__author">{{ implode(', ', $song->authors->pluck('name')->toArray()) }}</span>
                                                    </div>
                                                </td>
                                                <td class="track__album">
                                                    <span class="a-album" data-id="{{ $song->album->id }}">
                                                        {{ $song->album->title }}
                                                    </span>
                                                </td>
                                                <td class="track__time">
                                                </td>
                                            </tr>
                                        @empty
                                            <td> {{ __('no_data') }}</td>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="overview__albums">
                            <div class="overview__albums__head">
                                <span class="section-title">Albums</span>
                            </div>
                            @forelse ($albums as $album)
                                <div class="album-item">
                                    <div class="album__info">
                                        <div class="album__info__art">
                                            @if ($album->songs->count())
                                                <img src="{{ asset($album->songs->first()->thumbnail) }}"
                                                    alt="burn-out">
                                            @endif
                                        </div>
                                        <div class="album__info__meta">
                                            <div class="album__year">{{ $album->songs->count() }}
                                                {{ __('songs') }}</div>
                                            <div class="album__name">{{ $album->title }}</div>
                                            <div class="album__actions">
                                                <button data-id="{{ $album->id }}"
                                                    class="album button-light save">{{ __('view') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p> {{ __('no_data') }}</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
