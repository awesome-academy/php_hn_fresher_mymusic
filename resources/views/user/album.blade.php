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
                    <span class="info__amount">{{ $album->songs->count() }} {{ __('songs')}}</span>
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
                                            <td>
                                                <i class="fa-solid fa-clock"></i>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($album->songs as $key => $song)
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
                        <div class="related">
                            <div class="section-title">{{__('moreby')}} {{$album->author->name}}</div>
                            <x-list class-name="albums" list-title="" heading-class="mt-5">
                                @forelse ($relatedAlbum as $album)
                                    <x-card card-class="album" :card-name="$album->title" :description="$album->description" :data-id="$album->id">
                                        @if ($album->songs->count())
                                            <img src="{{asset($album->songs->first()->thumbnail)}}" alt="burn-out">
                                        @endif
                                    </x-card>
                                @empty
                                    <p> {{ __('no_data') }}</p>
                                @endforelse
                            </x-list>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
