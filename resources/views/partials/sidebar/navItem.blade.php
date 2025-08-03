<li class="nav-item {{ Route::currentRouteName() == $routeName ? 'active' : '' }}">
    <a href="{{ route($routeName) }}" class="nav-link">
        <i class="link-icon" data-feather="{{ $icon }}"></i>
        <span class="link-title">{{ $name }}</span>
    </a>
</li>
