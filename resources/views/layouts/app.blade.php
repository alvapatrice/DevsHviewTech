<!DOCTYPE html>
<html lang="en" ng-app="devArt">
<head>
    <base href="/">
    @if(isset($article->title))
        <title>{{ $article->title }}</title>
    @elseif(isset($page_title))
        <title>{{ $page_title }}</title>
    @else
        <title>Devs@HviewTech is a group of developers who are gathered in hviewtech ltd .</title>
    @endif

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}"/>

    <!-- Open graph Tags -->
    @if(! isset($article->title))
    <meta property="og:title" content="PHP, Java, Python, CSS3, HTML5, Javascript tutorial"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://devs.hviewtech.rw"/>
    <meta property="og:image" content="http://hviewtech.rw/images/logo.jpg"/>
    <meta property="og:site_name" content="devs.hviewtech.rw"/>
    <meta property="og:description"
          content="Devs@HviewTech is a team of developers which focuses on providing tips, snippets and tutorials about software development, with much focus on Java, Python,PHP, Javascript or other new cool stuff that we find interesting."/>
    <meta name="author" content="Nostalgie Patrice">
    @endif        
    

    @if(isset($article->description))
        @yield('head')
    @else
        <meta name="description"
              content="Devs@HviewTech is a team of developers which focuses on providing tips, snippets and tutorials about software development, with much focus on Java, Python,PHP, Javascript or other new cool stuff that we find interesting.">
        @endif
            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link href='http://fonts.googleapis.com/css?family=Roboto:500,100,300,700,400' rel='stylesheet'>
        {{--<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>--}}
        {{--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>--}}
        <!-- Css -->
        @if( getenv('APP_ENV') == 'production')
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        @else
            <link rel="stylesheet" href="/js/bower_components/bootstrap/dist/css/bootstrap.min.css">
        @endif
        <link href="/css/app.css" rel="stylesheet">
        <link href="/js/bower_components/PACE/themes/yellow/pace-theme-minimal.css" rel="stylesheet">

        @if( getenv('APP_ENV') == 'production')
            {{--Google Ad script--}}
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <script>
                (function (i, s, o, g, r, a, m) {
                    i['GoogleAnalyticsObject'] = r;
                    i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
                    a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                    a.async = 1;
                    a.src = g;
                    m.parentNode.insertBefore(a, m)
                })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

                ga('create', 'UA-61536196-1', 'auto');
                ga('send', 'pageview');
            </script>
        @endif

        <link rel="icon" type="image/png" href="/images/logos/favicon.png">
</head>
<body ng-controller="AppController as app">
<div class="container-fluid site-container" ng-click="app.hideSidebar()">
    @include('layouts.partials.flash_message')
    @include('layouts.partials.error_message')
    @yield('navbar')
    @yield('optionsbar')
    @yield('hero')
    <div class="content-area">
        @yield('content')
    </div>
    @yield('disquss')
    @include('layouts.partials.footer')
</div>
@yield('modalbox')


@if( getenv('APP_ENV') == 'production')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
    <script src="/js/bower_components/angular-cookies/angular-cookies.min.js"></script>
    <script src="/js/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="/js/bower_components/PACE/pace.min.js"></script>
    <script src="/js/app.min.js"></script>
@else
    <script src="/js/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/js/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/js/bower_components/angular/angular.min.js"></script>
    <script src="/js/bower_components/angular-cookies/angular-cookies.min.js"></script>
    <script src="/js/bower_components/lighter/javascripts/jquery.lighter.js"></script>
    <script src="/js/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="/js/bower_components/PACE/pace.min.js"></script>
    <script src="/js/app.js"></script>
@endif

 
{{--<script src="/js/custom.js"></script>--}}
@yield('scripts')
</body>
</html>