<nav class="sidebar">
    <div class="sidebar-header">

        <a href="{{ route('index') }}" class="sidebar-brand">
            DEB<span>tors</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            @include('partials.sidebar.navItem', [
                'name' => 'Дешборд',
                'routeName' => 'index',
                'icon' => 'box',
            ])
            <li class="nav-item nav-category">Главное</li>

            @include('partials.sidebar.navItem', [
                'name' => 'Должники',
                'routeName' => 'debtors.index',
                'icon' => 'users',
            ])

            {{--          

            @if (auth()->user()->hasRole('Администратор'))
                <li class="nav-item nav-category">Пользователи</li>
                @include('partials.sidebar.navItem', [
                    'name' => 'Пользователи',
                    'routeName' => 'users.index',
                    'icon' => 'users',
                ])
            @endif
 --}}


        </ul>
    </div>
</nav>
