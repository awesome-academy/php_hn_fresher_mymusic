<div class="content__middle">
    <div class="categrory is-verified">
        <div class="header">
            <div class="info">
                <div class="profile__img">
                    @if ($playlist->songs->count())
                        <img src="{{ asset($playlist->songs->first()->thumbnail) }}" alt="">
                    @endif
                </div>
                <div class="info__meta">
                    <div class="info__type">{{ __('your_playlist') }}</div>
                    <div class="info__name">{{ $playlist->name }}</div>
                    <div class="info__description">{{ $playlist->user->full_name }}</div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="overview">
                    <div class="overview">
                        <div class="overview_item">
                            <div class="section-title">{{ $playlist->name }}</div>
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
                                        @forelse ($playlist->songs as $key => $song)
                                            <tr class="track" data-song="{{ $song->path }}" data-title="{{ $song->name }}"
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
                                                    @if(!empty($song->album))
                                                    <span class="a-album" data-id="{{ $song->album->id}}">
                                                        {{ $song->album->title }}
                                                    </span>
                                                    @endif
                                                </td>
                                                <td class="track__time">
                                                    {{$song->time_song}}
                                                </td>
                                            </tr>
                                        @empty
                                            <td> {{ __('no_data') }}</td>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>