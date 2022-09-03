@include('layout.head')
@include('layout.head_form')

<body>
    @include('layout.header_tables')

    @include('layout.sidebar_tables')
    @yield('content')

    @include('layout.js_form')

    @yield('js')

</body>

</html>