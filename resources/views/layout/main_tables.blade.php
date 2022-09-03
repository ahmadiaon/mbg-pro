@include('layout.head')

@include('layout.head_tables')

<body>
    @include('layout.header_tables')

    @include('layout.sidebar_tables')

    @yield('content')

    @include('layout.js_tables')

    @yield('js')
</body>

</html>