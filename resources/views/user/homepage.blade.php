<div class="container-fluid pt-3">
    <x-list class-name="categories" list-title="Categories">
        @forelse ($categories as $category )
            <x-card :card-name="$category->name" :description="$category->description">
                @if ($category->songs->count())
                    <img src="{{ asset($category->songs->first()->thumbnail) }}" alt="burn-out">
                @endif
            </x-card>
        @empty
            <p> {{ __('no_data') }}</p>
        @endforelse
    </x-list>
    <x-list class-name="songs" list-title="Hot Song" heading-class="mt-5">
        @forelse ($songs as $song)
            <x-card :card-name="$song->name" :description="implode(', ',$song->authors->pluck('name')->toArray())"
                :data-song="$song->path" :data-title="$song->name" :data-thumbnail="$song->thumbnail"
                :data-author="implode(', ',$song->authors->pluck('name')->toArray())">
                <img src="{{ asset($song->thumbnail) }}" alt="burn-out">
            </x-card>
        @empty
            <p> {{ __('no_data') }}</p>
        @endforelse

    </x-list>
    <x-list class-name="albums" list-title="Albums" heading-class="mt-5">
        @forelse ($albums as $album)
            <x-card :card-name="$album->title" :description="$album->description">
                @if ($album->songs->count())
                    <img src="{{asset($album->songs->first()->thumbnail)}}" alt="burn-out">
                @endif
            </x-card>
        @empty
            <p> {{ __('no_data') }}</p>
        @endforelse
    </x-list>
    <x-list class-name="authors" list-title="Authors" heading-class="mt-5">
        @forelse ($authors as $author)
            <x-card :card-name="$author->name" :description="$author->description">
                <img src="{{asset($author->thumbnail)}}" alt="burn-out">
            </x-card>
        @empty
            <p> {{ __('no_data') }}</p>
        @endforelse
    </x-list>
</div>
