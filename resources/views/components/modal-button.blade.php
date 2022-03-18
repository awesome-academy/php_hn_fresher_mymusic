<!-- Button trigger modal -->
@props(['x-id', 'x-title'])

<button type="button" class="btn btn-primary" data-toggle="modal" title="{{ $xTitle }}" data-target="#{{ $xId }}">
    {{ $slot }}
</button>
