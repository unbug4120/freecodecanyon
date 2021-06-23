<html>

<head>
    <link rel="canonical" href="{{url()->full()}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="author" content="Freecodecanyon.net">
    @if (trim($__env->yieldContent('description')))
    <meta name="description" content="@yield('description')">
    @endif
    <meta name="keywords" content=""/>
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{url()->full()}}">
    <meta property="og:title" content="@yield('title')">
    @if (trim($__env->yieldContent('description')))
    <meta property="og:description" content="@yield('description')">
    @endif
    @if (trim($__env->yieldContent('thumb')))
    <meta property="og:image" content="{{url('/storage')}}/@yield('thumb')">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{url()->full()}}">
    <meta property="twitter:title" content="@yield('title')">
    @if (trim($__env->yieldContent('description')))
    <meta property="twitter:description" content="@yield('description')">
    @endif
    @if (trim($__env->yieldContent('thumb')))
    <meta property="twitter:image" content="{{url('/storage')}}/@yield('thumb')">
    @endif
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mulish&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">

    <link type="text/css" rel="stylesheet" href="/bootstrap.min.css">

    <link type="text/css" rel="stylesheet" href="/style.css">
</head>

<body>
    <header class="header-global">
        <nav id="navbar-main" class="navbar d-flex flex-row align-items-center navbar-main navbar-expand-lg navbar-dark justify-content-between">
            <ul class="navbar-nav navbar-nav-hover flex-row align-items-center">
                <li class="nav-item">
                    <a href="/" class="nav-link" role="button">
                        <span class="nav-link-inner-text">Home</span>
                    </a>
                </li>
            </ul>
            <div class="time text-center"></div>
        </nav>
    </header>
    <main>
        <section class="section section-lg bg-secondary overflow-hidden z-2">
            <div class="container z-2">
                <div class="row justify-content-center pt-6 pt-md-5 pb-0 mb-2">
                    <form action="{{ route('search') }}" method="GET">
                        <input type="text" name="q" placeholder="Search..." required />
                        <button type="submit">SEARCH</button>
                    </form>
                </div>
            </div>
        </section>
        @yield('content')
    </main>
    <footer>
        <nav id="navbar-footer" class="navbar navbar-main navbar-expand-lg navbar-dark justify-content-between navbar-footer">
            Copyright 2021 @ Freecodecanyon.net
        </nav>
    </footer>

    <script src="/popper.min.js"></script>
    <script src="/jquery.min.js"></script>
    <script src="/bootstrap.min.js"></script>

    <script src="/script.js"></script>
    @stack('script')
</body>

</html>