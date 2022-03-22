<tr class="track" data-song="{{ $song->path }}" data-title="{{ $song->name }}"
    data-thumbnail="{{ $song->thumbnail }}" data-id={{ $key }} song-id={{ $song->id }}
    data-fav="{{ $favorite->songs->contains($song)}}"
    data-author="{{ implode(', ', $song->authors->pluck('name')->toArray()) }}">
    <td class="track__number">{{ $key + 1 }}</td>
    <td class="track__art">
        <img src="{{ asset($song->thumbnail) }}" alt="{{ $song->name }}" />
        <div class="track__info">
            <span class="track__title">{{ $song->name }}</span>
            <span class="track__author">{{ implode(', ', $song->authors->pluck('name')->toArray()) }}</span>
        </div>
    </td>
    <td class="track__album">
        @if($song->album)
        <span class="a-album" data-id="{{ $song->album->id }}">
            {{ $song->album->title }}
        </span>
        @endif
    </td>
    <td class="track__time">
        {{ $song->time_song }}
    </td>
</tr>
