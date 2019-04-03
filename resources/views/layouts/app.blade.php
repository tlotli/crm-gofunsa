<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>
<!--Preloader-->
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<!--/Preloader-->
<div class="wrapper theme-1-active pimary-color-green">

    @include('layouts.top_menu_nav')
    @include('layouts.left_menu_nav')
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- Title -->
            <div class="row heading-bg">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    {{--<h5 class="txt-dark">@yield('page-title')</h5>--}}
                </div>
            </div>
            @yield('main-section')
        </div>
            @include('layouts.footer')
    </div>
</div>
             @include('layouts.script')
             @include('sweetalert::view')
</body>

</html>
