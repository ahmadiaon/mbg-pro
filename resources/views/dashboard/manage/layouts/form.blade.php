{{-- head --}}
@include('dashboard.layouts.head')

<body>
    {{-- sidebar --}}
    @include('dashboard.layouts.sidebar')
    <div class="mobile-menu-overlay"></div>

    <div class="main-container" style="padding-top: 10px;">
        <div class="pd-ltr-15 xs-pd-20-10">
            <div class="min-height-200px">
                {{-- header --}}
                @include('dashboard.layouts.header')
                {{-- main --}}
                @yield('container')
            </div>
            {{-- footer --}}
            @include('dashboard.layouts.footer')

        </div>
    </div>


    <script src="{{ env('APP_URL') }}/vendors/scripts/core.js"></script>
    <script src="{{ env('APP_URL') }}/vendors/scripts/script.min.js"></script>
    <script src="{{ env('APP_URL') }}/vendors/scripts/process.js"></script>
    <script src="{{ env('APP_URL') }}/vendors/scripts/layout-settings.js"></script>


    {{-- @yield('javascript') --}}
    @yield('javascripts')
</body>

</html>
