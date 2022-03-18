@props(['x-id', 'x-title', 'x-size'])

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal modal-custom fade" id="{{ $xId }}" tabindex="-1" aria-labelledby="{{ $xId }}Label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered {{ isset($xSize) ? 'modal-' . $xSize : '' }}">
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
