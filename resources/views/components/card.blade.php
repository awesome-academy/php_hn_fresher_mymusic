@props(['card-name', 'description'])

<div class="card-box" {{ $attributes }}>
    <div class="card-img">
        {{ $slot }}
    </div>
    <h6 class="card-text card-name" title="{{ $cardName }}">{{ $cardName }}</h6>
    <small class="card-text card-desc" title="{{ $description }}">{{ $description }}</small>
</div>
