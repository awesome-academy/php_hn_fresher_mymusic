<div class="content__middle">
    <div class="categrory is-verified">
        <div class="header">
            <div class="info">
                <div class="profile__img">
                    @if ($album->songs->count())
                        <img src="{{ asset($album->author->thumbnail) }}" alt="">
                    @endif
                </div>
                <div class="info__meta">
                    <div class="info__type">Albums</div>
                    <div class="info__name">{{ $album->title }}</div>
                    <div class="info__description">{{ $album->description }}</div>
                    <span class="info__author">{{ __('Author') }} : {{ $album->author->name }}</span>
                    <span class="info__amount">{{ $album->songs->count() }} {{ __('songs') }}</span>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="overview">
                    <div class="overview">
                        <div class="overview_item">
                            <div class="section-title">{{ $album->title }}</div>
                            <div class="tracks">
                                <table>
                                    <thead>
                                        <tr class="title-table">
                                            <td class="track__number">#</td>
                                            <td>{{ __('song_name') }}</td>
                                            <td>{{ __('album_title') }}</td>
                                            <td>
                                                <i class="fa-solid fa-clock"></i>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($album->songs as $key => $song)
                                            @include('user.track')
                                        @empty
                                            <tr>
                                                <td colspan="4"> {{ __('no_data') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="related overview__albums">
                            <div class="section-title">{{ __('moreby') }} {{ $album->author->name }}</div>
                            @forelse ($relatedAlbum as $album)
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
