@include('layout_admin.head')

<body>


    @include('layout_admin.header')

    @include('layout.sidebar_tables')

    <div class="mobile-menu-overlay"></div>

    @yield('content')

    <!-- welcome modal end -->
    @include('layout_admin.js_core')
    @yield('js')

</body>

</html>