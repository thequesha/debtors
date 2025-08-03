<nav class="navbar  bg-primary">
    @include('partials.navbar.sidebar-toggler')

    <div class="navbar-content">

        <ul class="navbar-nav">
            {{-- @include('partials.navbar.lang') --}}
            {{-- @include('partials.navbar.apps') --}}
            {{-- @include('partials.navbar.messages') --}}
            {{-- @include('partials.navbar.notifications') --}}
            {{-- @include('partials.navbar.home') --}}
            @include('partials.navbar.profile')
        </ul>
    </div>
</nav>
