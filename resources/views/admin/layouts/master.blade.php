<!DOCTYPE html>
<html class="no-js before-run" lang="en" ng-app="devArt">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">

    <title>Dashboard | Devartisans Admin Area</title>

    <link rel="apple-touch-icon" href="/dashboard/images/apple-touch-icon.png">
    <link rel="shortcut icon" type="image/png" href="/images/logos/favicon.png">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="/dashboard/css/bootstrap.min.css">
    <link rel="stylesheet" href="/dashboard/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="/dashboard/css/site.min.css">
    <link rel="stylesheet" href="/dashboard/css/custom.css">

    <link rel="stylesheet" href="/dashboard/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="/dashboard/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="/dashboard/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="/dashboard/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="/dashboard/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="/dashboard/vendor/flag-icon-css/flag-icon.css">

    <!-- Fonts -->
    <link rel="stylesheet" href="/dashboard/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="/dashboard/fonts/font-awesome/font-awesome.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!-- Plugin -->
    @yield('css')
    <link rel="stylesheet" href="/dashboard/vendor/filament-tablesaw/tablesaw.css">
    <link rel="stylesheet" href="/dashboard/vendor/toastr/toastr.css">

    <!--[if lt IE 9]>
    <script src="/dashboard/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="/dashboard/vendor/media-match/media.match.min.js"></script>
    <script src="/dashboard/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="/dashboard/vendor/modernizr/modernizr.js"></script>
    <script src="/dashboard/vendor/breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>
</head>
<body class="dashboard" ng-controller="AppController as app">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    @include('admin.layouts.navbar-header')
    <div class="navbar-container container-fluid">
        @include('admin.layouts.navbar-collapse')
            <!-- Site Navbar Seach -->
        <div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search">
                <div class="form-group">
                    <div class="input-search">
                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="site-search" placeholder="Search...">
                        <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
                                data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End Site Navbar Seach -->
    </div>
</nav>
@include('admin.layouts.side-nav')

    <!-- Page -->
<div class="page">
    @include('admin.layouts.page-header')
    <div class="page-content">
        @yield('content')
    </div>
</div>
<!-- End Page -->


<!-- Footer -->
<footer class="site-footer">
    <span class="site-footer-legal">&copy; 2017 hviewtech.rw</span>
    <div class="site-footer-right">
    </div>
</footer>

@if( getenv('APP_ENV') == 'production')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular-cookies.min.js"></script>
    <script src="/js/app.min.js"></script>
@else
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bower_components/angular/angular.min.js"></script>
    <script src="/js/bower_components/angular-cookie/angular-cookies.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/jquery.lighter.js"></script>
@endif
<!-- Core  -->

{{-- Already loded at top --}}
{{--<script src="/dashboard/vendor/jquery/jquery.js"></script>--}}
{{--<script src="/dashboard/vendor/bootstrap/bootstrap.js"></script>--}}


<script src="/dashboard/vendor/animsition/jquery.animsition.js"></script>
<script src="/dashboard/vendor/asscroll/jquery-asScroll.js"></script>
<script src="/dashboard/vendor/mousewheel/jquery.mousewheel.js"></script>
<script src="/dashboard/vendor/asscrollable/jquery.asScrollable.all.js"></script>
<script src="/dashboard/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

<!-- Plugins -->
@yield('scripts')
<script src="/dashboard/vendor/switchery/switchery.min.js"></script>
<script src="/dashboard/vendor/intro-js/intro.js"></script>
<script src="/dashboard/vendor/screenfull/screenfull.js"></script>
<script src="/dashboard/vendor/slidepanel/jquery-slidePanel.js"></script>
<script src="/dashboard/vendor/toastr/toastr.js"></script>

<!-- Scripts -->
<script src="/dashboard/js/core.js"></script>
<script src="/dashboard/js/site.js"></script>

<script src="/dashboard/js/sections/menu.js"></script>
<script src="/dashboard/js/sections/menubar.js"></script>
<script src="/dashboard/js/sections/sidebar.js"></script>

<script src="/dashboard/js/configs/config-colors.js"></script>
<script src="/dashboard/js/configs/config-tour.js"></script>


<script src="/dashboard/js/components/asscrollable.js"></script>
<script src="/dashboard/js/components/animsition.js"></script>
<script src="/dashboard/js/components/slidepanel.js"></script>
<script src="/dashboard/js/components/switchery.js"></script>
<script src="/dashboard/js/components/toastr.js"></script>
<script>
    (function(document, window, $) {
        'use strict';

        var Site = window.Site;
        $(document).ready(function() {
            Site.run();
        });
    })(document, window, jQuery);
</script>
@include('admin.layouts.toaster')
</body>

</html>