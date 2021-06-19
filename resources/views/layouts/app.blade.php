<html>

<head>
    <link rel="canonical" href="https://themesberg.com/product/ui-kit/windows-95-ui-kit">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="author" content="Themesberg">
    <meta name="description" content="Windows 95 is a free Retro UI Kit to bring back the great memories of the 95's. Original Windows 95 Buttons, Icons, Windows, Tabs and many more await you!">
    <meta name="keywords" content="Windows 95, Windows 95 UI Kit, Windows 95 Buttons, Windows 95 Cards, Windows 95 Icons, Windows 95 Forms, Windows 95 Typography, Windows 95 Website, Retro Website, Bootstrap Retro, Themesberg" />

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://themesberg.com/product/ui-kit/windows-95-ui-kit">
    <meta property="og:title" content="Windows 95 UI Kit">
    <meta property="og:description" content="Windows 95 is a free Retro UI Kit to bring back the great memories of the 95's. Original Windows 95 Buttons, Icons, Windows, Tabs and many more await you!">
    <meta property="og:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/windows-95/windows-95-ui-kit-preview.jpg">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://themesberg.com/product/ui-kit/windows-95-ui-kit">
    <meta property="twitter:title" content="Windows 95 UI Kit">
    <meta property="twitter:description" content="Windows 95 is a free Retro UI Kit to bring back the great memories of the 95's. Original Windows 95 Buttons, Icons, Windows, Tabs and many more await you!">
    <meta property="twitter:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/windows-95/windows-95-ui-kit-preview.jpg">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mulish&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/site.webmanifest">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">

    <link type="text/css" rel="stylesheet" href="./bootstrap.min.css">

    <link type="text/css" rel="stylesheet" href="./style.css">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-141734189-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-141734189-1');
    </script>
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
        @yield('content')
    </main>
    <footer>
        <nav id="navbar-footer" class="navbar navbar-main navbar-expand-lg navbar-dark justify-content-between navbar-footer">
            Copyright 2021 @ Freecodecanyon.net
        </nav>
    </footer>

    <script src="./popper.min.js"></script>
    <script src="./jquery.min.js"></script>
    <script src="./bootstrap.min.js"></script>

    <script src="./script.js"></script>
    @stack('script')
</body>

</html>