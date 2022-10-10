@include('layout_adm.head')

@if(!empty($layout['head_form']) )
    @include('layout_adm.head_form')
@endif

@if($layout['head_datatable'])
@include('layout_adm.head_datatable')
@endif

@yield('head')
</head>

<body id="body">
    {{-- <div id="loader" class="center"></div> --}}
    @include('layout_adm.header')

    @if(session('dataUser')->role == 'admin-ob')
    @include('layout_adm.admin_ob_sidebar')

    @elseif(session('dataUser')->role == 'admin-hr')
    @include('layout_adm.admin_hr_sidebar')

    @elseif(session('dataUser')->role == 'foreman')
    @include('layout_adm.admin_foreman_sidebar')

    @elseif(session('dataUser')->role == 'safety')
    @include('layout_adm.admin_safety_sidebar')

    @elseif(session('dataUser')->role == 'superadmin')
    @include('layout_adm.admin_superadmin_sidebar')

    @elseif(session('dataUser')->role == 'logistic')
    @include('layout_adm.admin_logistic_sidebar')

    @elseif(session('dataUser')->role == 'employee')
    @include('layout_adm.admin_employee_sidebar')

    @elseif(session('dataUser')->role == 'engineer')
    @include('layout_adm.admin_engineer_sidebar')

    @elseif(session('dataUser')->role == 'payrol')
    @include('layout_adm.admin_payrol_sidebar')

    @elseif(session('dataUser')->role == 'purchase-order')
    @include('layout_adm.admin_purchase_order_sidebar')

    @else

    @include('layout_adm.public_purchase_order_sidebar')

    @endif


    <div class="mobile-menu-overlay"></div>

    @yield('content')

    <!-- welcome modal end -->
    @include('layout_adm.js_core')

    {{-- javascript datatable --}}
    @if($layout['javascript_datatable'])

    @include('layout_adm.javascript_table')
    @endif
    @if($layout['javascript_form'])

    @include('layout_adm.javascript_form')
    @endif
    


    @yield('js')

</body>

</html>