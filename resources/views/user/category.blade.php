<div class="content__middle">
    <div class="categrory is-verified">
        <div class="categrory__header">
            <div class="categrory__info">
                <div class="profile__img">
                    @if ($category->songs->count())
                        <img src="{{ asset($category->songs->first()->thumbnail) }}" alt="">
                    @endif
                </div>
                <div class="categrory__info__meta">
                    <div class="categrory__info__type">Category</div>
                    <div class="categrory__info__name">{{ $category->name }}</div>
                    <div class="categrory__info__description">{{ $category->description }}</div>
                </div>
            </div>
        </div>
        <div class="categrory__content">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="categrory-overview">
                    <div class="overview">
                        <div class="overview_category">
                            <div class="section-title">{{ $category->name }}</div>
                            <div class="tracks">
                                <table>
                                    <thead>
                                        <tr>
                                            <td class="track__number">#</td>
                                            <td>{{ __('song_name') }}</td>
                                            <td>{{ __('album_title') }}</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($category->songs as $key => $song)
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
                                                <td class="track__plays">{{ $song->album->title }}</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
