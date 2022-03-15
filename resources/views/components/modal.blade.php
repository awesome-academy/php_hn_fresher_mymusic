@props(['x-id', 'x-title', 'x-button', 'x-size'])

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" title="{{ $xTitle }}" data-target="#{{ $xId }}">
    {!! $xButton !!}
</button>

<!-- Modal -->
<div class="modal fade" id="{{ $xId }}" tabindex="-1" aria-labelledby="{{ $xId }}Label"
    aria-hidden="true">
    <div class="modal-dialog {{ isset($xSize) ? 'modal-' . $xSize : '' }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $xId }}Label"> {{ $xTitle }} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
