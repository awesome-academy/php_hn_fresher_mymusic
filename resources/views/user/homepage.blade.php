<div class="container-fluid pt-3">
    <x-list class-name="your-playlist" list-title="Your Playlist">
        {{-- Fake Data Playlist --}}
        {{-- <x-card :card-name="'Lorem ipsum dolor sit amet consectetur adipisicing elit.'"
            description="Iure debitis eum consequuntur doloribus aperiam.">
            <img src="{{ asset('bower_components/user_template/assets/img/music/song2.jpg') }}" alt="burn-out">
        </x-card> --}}
    </x-list>
    <x-list class-name="v-pop" list-title="Hot V-pop" heading-class="mt-5">
        @forelse ($songs as $song )
        <x-card card-name="{{ $song->name }}" description="{{ $song->description}}"
            data-song="{{ $song->path}}" data-title="{{ $song->name}}" data-thumbnail="{{ $song->thumbnail }}">
            <img src="{{ asset($song->thumbnail) }}" alt="burn-out">
        </x-card>
        @empty
            <p> {{ __('no_data') }}</p>
        @endforelse

    </x-list>
</div>
