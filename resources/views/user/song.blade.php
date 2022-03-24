<div class="content__middle">
    <div class="categrory is-verified">
        <div class="header">
            <div class="info">
                <div class="profile__img">
                    <img src="{{ asset($song->thumbnail) }}" alt="">
                </div>
                <div class="info__meta">
                    <div class="info__type">{{ __('song') }}</div>
                    <div class="info__name">{{ $song->name }}</div>
                    <div class="info__description">{{ $song->description }}</div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="overview">
                    <div class="overview">
                        <div class="overview_item">
                            <div class="section-title">{{ $song->name }}</div>
                            <div class="tracks">
                                <table>
                                    <thead>
                                        <tr class="title-table">
                                            <td>{{ __('song_name') }}</td>
                                            <td>{{ __('album_title') }}</td>
                                            <td><i class="fa-solid fa-clock"></i></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="track track-active" data-song="{{ $song->path }}"
                                            data-title="{{ $song->name }}" data-thumbnail="{{ $song->thumbnail }}"
                                            song-id={{ $song->id }}
                                            data-fav="{{ $favorite ? $favorite->songs->contains($song) : false }}"
                                            data-author="{{ implode(', ', $song->authors->pluck('name')->toArray()) }}">
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
                                                @if ($song->album)
                                                    <span class="a-album" data-id="{{ $song->album->id }}">
                                                        {{ $song->album->title }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="track__time">
                                                {{ $song->time_song }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="comment-section row">
                        <div class="col-8 interact-comment-form">
                            <div class="section-title">{{ __('comments') }}</div>
                            <div class="comment-form">
                                <div class="comment-form-mess">
                                    <form action="" method="POST">
                                        @csrf
                                        <input name="commentable_id" value="" hidden>
                                        <input type="text" name="user_id" value="{!! Auth::check() ? Auth::user()->id : '' !!}" hidden>
                                        <input name="commentable_type" value="posts" hidden>
                                        <textarea class="message" placeholder="{{ __('comment-content')}}" name="content" cols="30" rows="5"></textarea>
                                        <button type="submit" class="send-mess-btn">
                                            <i class="fa-solid fa-paper-plane"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="comment-form-body">
                                    <div class="comment-body-items">
                                        <div class="avatar-account">
                                            <img src="{{ asset('/storage/user/avatar/1571802458800-600-1647912643.jpg') }}" alt="">
                                        </div>
                                        <div class="comment-content">
                                            <div class="name-account"></div>
                                            <div class="comment"></div>
                                            <div class="option option-comment">
                                                <div class="option-left">
                                                    <a class="comment-reply">
                                                        <span class="reply-show">{{ __('reply') }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="comment-form-mess reply-input">
                                                <form action="" method="POST">
                                                    @csrf
                                                    <input name="commentable_id" value="" hidden>
                                                    <input type="email" name="user_id" value="{!! Auth::check() ? Auth::user()->id : '' !!}" hidden>
                                                    <input name="commentable_type" value="posts" hidden>
                                                    <textarea maxlength="150" class="message" placeholder="{{ __('comment_content')}}" name="content" cols="30"rows="6"></textarea>
                                                    <button type="submit" class="send-mess-btn">
                                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="reply-list">
                                                <div class="reply-item">
                                                    <div class="avatar-account">
                                                        <img src="{{ asset('/storage/user/avatar/1571802458800-600-1647912643.jpg') }}" alt="">
                                                    </div>
                                                    <div class="reply-items-content">
                                                        <div class="name-account"></div>
                                                        <div class="comment"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4 related-song">
                            <div class="section-title">{{ __('related_song') }}</div>
                            <div class="related-song">
                                <div class="related-song-item">
                                    <div class="related-song-info">
                                        <div class="related-song-thumbnail">
                                            <img src="{{ asset($song->thumbnail) }}" alt="burn-out">
                                        </div>
                                        <div class="related-song-title">
                                            <div class="related-song-name">{{ $song->name }}</div>
                                            <div class="related-song-author">
                                                {{ implode(', ', $song->authors->pluck('name')->toArray()) }}
                                            </div>
                                        </div>
                                        <div class="related-time-song">
                                            {{ $song->time_song }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
