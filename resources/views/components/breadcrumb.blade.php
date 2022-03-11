@props(['items'])

@props(['items'])
<nav class="pt-1">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('dashboard') }}</a></li>
        @foreach ($items as $index => $item)
            <li class="breadcrumb-item @if ($loop->last) active @endif">{{ __($item) }}</li>
        @endforeach
    </ol>
</nav>
