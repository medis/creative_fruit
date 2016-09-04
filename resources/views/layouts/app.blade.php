<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10" lang=""> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/normalize.css">
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
        <script src='https://www.google.com/recaptcha/api.js'></script>
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
        <div class="page-row">
          <header id="header">
              <a href="{{ route('works') }}" class="logo"><img src="/images/Logo.png" alt="Creative Fruit logo" /></a>
              <nav>
                  <h2 class="visually-hidden">Main navigation</h2>
                  <ul>
                      <li><a href="{{ route('works') }}">WORK</a></li>
                      <li><a href="{{ route('about') }}">ABOUT</a></li>
                      <li><a href="{{ route('videos') }}">VIDEOS</a></li>
                      <li><a href="{{ route('contact') }}">CONTACT</a></li>
                  </ul>
              </nav>
              <div class="clearfix border"></div>
              <div class="background"></div>
          </header>
        </div>
        <div class="page-row page-row-expanded">
          <div class="container">
              @if (Session::has('message'))
                  <div class="flash isa_success inner-container">
                      <i class="fa fa-info-circle"></i>
                      <span>{{ Session::get('message') }}</span>
                  </div>
              @endif
              @if ($errors->any())
                @foreach ( $errors->all() as $error )
                  <div class='flash isa_error inner-container'>
                      <i class="fa fa-times-circle"></i>
                      <span>{{ $error }}</span>
                  </div>
                @endforeach
              @endif
              <div class="page-info inner-container">
                  <h1>@yield('title')</h1>
                  <div class="title-meta">@yield('title_meta')</div>
              </div>
              <div class="content">
                  @yield('content')
              </div>
          </div>
        </div>
        <div class="page-row">
          <footer>
            <span>Creative Fruit © {{ date('Y') }}</span>
          </footer>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>
        <script src="/js/vendor/jquery.sticky.js"></script>
        <script src="/js/vendor/masonry.pkgd.min.js"></script>
        <script src="/js/vendor/TweenMax.min.js"></script>
        <script src="//npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
        @yield('assets')
        <script src="{{ elixir('js/all.js') }}" type="text/javascript"></script>

        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-83532204-1','auto');ga('send','pageview');
        </script>
    </body>
</html>
