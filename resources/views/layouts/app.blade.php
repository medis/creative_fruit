<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="/css/normalize.css">
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">

        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        @if (Auth::check())
            <div class="admin-menu">
                <ul>
                    <li><a href='/work/new' title="Create new work">Create new work</a></li>
                    <li><a href="{{ route('admin_works') }}" title="Administer all works">Administer works</a></li>
                </ul>
            </div>
        @endif
        <header>
            <a href="/" class="logo"><img src="/images/Logo.png" alt="Creative Fruit logo" /></a>
            <nav>
                <h2 class="visually-hidden">Main navigation</h2>
                <ul>
                    <li><a href="{{ route('works') }}">WORK</a></li>
                    <li><a href="{{ route('about') }}">ABOUT</a></li>
                    <li><a href="#">VIDEOS</a></li>
                    <li><a href="{{ route('contact') }}">CONTACT</a></li>
                </ul>
            </nav>
        </header>
        <div class="container">
            @if (Session::has('message'))
                <div class="flash alert-info">
                    <p class="panel-body">{{ Session::get('message') }}</p>
                </div>
            @endif
            @if ($errors->any())
                <div class='flash alert-danger'>
                    <ul class="panel-body">
                        @foreach ( $errors->all() as $error )
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
              </div>
            @endif
            <div class="page-info">
                <h1>@yield('title')</h1>
                <div class="title-meta">@yield('title_meta')</div>
            </div>
            <div class="content">
                @yield('content')
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        @yield('assets')
        <script src="{{ elixir('js/all.js') }}" type="text/javascript"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
