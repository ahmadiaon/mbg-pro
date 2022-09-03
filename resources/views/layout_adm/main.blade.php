@include('layout_adm.head')

@if($layout['head_form'])
@include('layout_adm.head_form')
@endif

@if($layout['head_datatable'])
@include('layout_adm.head_datatable')
@endif

@yield('head')
</head>

<body>

    @include('layout_adm.header')

    @if(session('dataUser')->group == 'admin-ob')
    @include('layout_adm.admin_ob_sidebar')

    @elseif(session('dataUser')->group == 'admin-hr')
    @include('layout_adm.admin_hr_sidebar')

    @elseif(session('dataUser')->group == 'foreman')
    @include('layout_adm.admin_foreman_sidebar')

    @elseif(session('dataUser')->group == 'superadmin')
    @include('layout_adm.admin_superadmin_sidebar')

    @else

    @include('layout_adm.bank_sidebar')

    @endif


    <div class="mobile-menu-overlay"></div>

    @yield('content')

    <!-- welcome modal end -->
    @include('layout_adm.js_core')

    {{-- javascript datatable --}}
    @if($layout['javascript_datatable'])

    @include('layout_adm.javascript_table')
    @endif


    @yield('js')

</body>

</html>