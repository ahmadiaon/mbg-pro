@include('layout.head')
@include('layout.superadmin.form_head')

<body>
    @include('layout.header_tables')

    @include('layout.superadmin.basic_sidebar')
    @yield('content')

    @include('layout.js_form')

    @yield('js')

</body>

</html>