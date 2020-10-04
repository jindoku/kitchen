<!DOCTYPE html>
<html lang="en">

<head>
    <title>QLBH-TBNB | @yield('head.title')</title>
    @include('component.layout.head')
    @yield('head.css')
</head>

<body>
<!-- Pre-loader start -->
@include('component.layout.theme-loader')
<!-- Pre-loader end -->
<div class="waitting-preloader preloader3 display-none">
    <div class="circ1 loader-lg"></div>
    <div class="circ2 loader-lg"></div>
    <div class="circ3 loader-lg"></div>
    <div class="circ4 loader-lg"></div>
</div>
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">
        <!-- Menu header start -->
        @include('component.layout.nav-header')
        <!-- Menu header end -->

        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <!-- Menu header start -->
                @include('component.layout.sidebar')
                <!-- Menu header end -->
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <div class="main-body">
                            <div class="page-wrapper">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('component.layout.script')
@yield('script')
</body>

</html>
