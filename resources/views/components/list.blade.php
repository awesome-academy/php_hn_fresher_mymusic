@props(['class-name', 'list-title', 'heading-class'])

<div class="row">
    <div class="col-lg-12 horizontal-list-header">
        <h4 class="horizontal-list-title {{ $headingClass ?? '' }}">{{ $listTitle }}</h4>
        <a href="#">{{ __('View all') }}</a>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="side horizontal-list-slick {{ $className }}">
            {{ $slot }}
        </div>
    </div>
</div>
