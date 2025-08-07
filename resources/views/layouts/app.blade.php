<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.sections.meta')
    <title>@yield('title') | debtors</title>
    @include('layouts.sections.favicon')
    @include('layouts.sections.links')
    @stack('css')
</head>

<body class="">
    <div class="main-wrapper">
        @include('partials.sidebar')

        <div class="page-wrapper">
            @include('partials.navbar')
            <div class="page-content">
                @yield('content')
            </div>
            @include('partials.footer')
        </div>
    </div>
    @include('layouts.sections.scripts')
    @stack('js')
</body>

</html>
