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
                                        <input name="song_id" value="{{ $song->id}}" hidden>
                                        <input name="parent_id" value="0" hidden>
                                        <textarea class="message" placeholder="{{ __('comment_content')}}" name="content" cols="30" rows="5"></textarea>
                                        <button type="submit" class="send-mess-btn">
                                            <i class="fa-solid fa-paper-plane"></i>
                                        </button>
                                    </form>
                                </div>
                                <div id="comment" class="comment-form-body">
                                   @forelse  ($comments as $comment )
                                    <div class="comment-body-items">
                                        <div class="avatar-account">
                                            <img src="{{ asset($comment->user->avatar) }}" alt="">
                                        </div>
                                        <div class="comment-content">
                                            <div class="name-account">{{ $comment->user->full_name }}</div>
                                            <div class="comment">{{ $comment->content }}</div>
                                            <div class="option option-comment">
                                                <div class="option-left">
                                                    <a class="comment-reply">
                                                        <span class="reply-show">{{ __('reply') }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="comment-form-mess reply-input" data-parent="{{ $comment->id}}">
                                                <form method="POST">
                                                    <input name="song_id" value="{{ $comment->song_id}}" hidden>
                                                    <input name="parent_id" value="{{ $comment->id }}" hidden>
                                                    <textarea class="message" placeholder="{{ __('comment_content') }}" name="content"></textarea>
                                                    <button type="button" class="send-mess-btn">
                                                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                                @foreach ($replies as $reply )
                                                    @if($reply->parent_id == $comment->id)
                                                    <div class="reply-list active">
                                                        <div class="reply-item">
                                                            <div class="avatar-account">
                                                                <img src="{{ asset($reply->user->avatar) }}" alt="">
                                                            </div>
                                                            <div class="reply-items-content">
                                                                <div class="name-account">{{ $reply->user->full_name }}</div>
                                                                <div class="comment">{{ $reply->content }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                    @empty
                                    @endforelse
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
