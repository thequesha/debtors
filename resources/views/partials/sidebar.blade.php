<nav class="sidebar">
    <div class="sidebar-header">

        <a href="{{ route('index') }}" class="sidebar-brand">
            PRO<span>auto</span>
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
                'name' => 'Машины (для заказов)',
                'routeName' => 'cars.index',
                'icon' => 'life-buoy',
            ])

            @include('partials.sidebar.navItem', [
                'name' => 'Шаблоны авто',
                'routeName' => 'car-templates.index',
                'icon' => 'layout',
            ])


            <li class="nav-item nav-category">Справочники</li>

            @include('partials.sidebar.navItem', [
                'name' => 'Марки',
                'routeName' => 'brands.index',
                'icon' => 'tag',
            ])

            @include('partials.sidebar.navItem', [
                'name' => 'Модели',
                'routeName' => 'car-models.index',
                'icon' => 'slack',
            ])

            @include('partials.sidebar.navItem', [
                'name' => 'Комплектации',
                'routeName' => 'trims.index',
                'icon' => 'layers',
            ])


            @include('partials.sidebar.navItem', [
                'name' => 'Типы двигателей',
                'routeName' => 'engine-types.index',
                'icon' => 'activity',
            ])

            @include('partials.sidebar.navItem', [
                'name' => 'Типы трансмиссии',
                'routeName' => 'transmission-types.index',
                'icon' => 'settings',
            ])

            {{-- @include('partials.sidebar.navItem', [
                'name' => 'Roles',
                'routeName' => 'roles.index',
                'icon' => 'pocket',
            ]) --}}


            @if (auth()->user()->hasRole('Администратор'))
                <li class="nav-item nav-category">Пользователи</li>
                @include('partials.sidebar.navItem', [
                    'name' => 'Пользователи',
                    'routeName' => 'users.index',
                    'icon' => 'users',
                ])
            @endif



        </ul>
    </div>
</nav>
