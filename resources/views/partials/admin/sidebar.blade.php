<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        @foreach (config('admin.sidebar') as $key => $item)
            <li class="nav-item">
                @if (isset($item['route']) && Route::has($item['route']))
                    @if (isset($item['submenu']))
                        <a class="nav-link collapsed justify-content-between" data-bs-target="#{{ $key }}-nav" data-bs-toggle="collapse" href="{{ route($item['route']) }}">
                    @else
                        <a class="nav-link collapsed justify-content-between" href="{{ route($item['route']) }}">
                    @endif
                        <span>
                            {!! $item['icon'] !!}
                            <span> {{ __($item['title']) }} </span>
                        </span>
                        @if (isset($item['submenu']))
                            <i class="bi bi-chevron-down ms-auto"></i>
                        @endif
                    </a>
                @else
                    <a class="nav-link collapsed justify-content-between" data-bs-target="#{{ $key }}-nav" data-bs-toggle="collapse" href="javascrip:void(0)">
                        <span>
                            {!! $item['icon'] !!}
                            <span> {{ __($item['title']) }} </span>
                        </span>
                        @if (isset($item['submenu']))
                            <i class="bi bi-chevron-down ms-auto"></i>
                        @endif
                    </a>
                @endif
                @if (isset($item['submenu']))
                    <ul id="{{ $key }}-nav" class="nav-content collapse @yield($key)" data-bs-parent="#sidebar-nav">
                        @foreach ($item['submenu'] as $subkey => $submenu )
                            @if (Route::has($submenu['route']))
                                <li>
                                    <a class="{{ request()->routeIs($submenu['route']) ? 'active' : '' }}" href="{{ route($submenu['route']) }}">
                                        <i class="bi bi-circle"></i>
                                        <span> {{ __($submenu['title']) }} </span>
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="bi bi-circle"></i>
                                        <span> {{ __($submenu['title']) }} </span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</aside>
<!-- End Sidebar-->
