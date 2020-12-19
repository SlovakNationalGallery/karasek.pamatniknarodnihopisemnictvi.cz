<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Virtuální galerie Jiřího Karáska připomímná významného českého básníka a zpřístupňuje bohatství jeho výtvarné sbírky, kterou spravuje Památník národního písemnictví. Prezentuje téměř 300 děl všech druhů, žánrů a období: obrazy, kresby, grafiky ale i plastiky.">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#ffc40d">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#ffffff">

    <meta property="og:title" content="Virtuální galerie Jiřího Karáska ze Lvovic" />
    <meta property="og:description" content="Virtuální galerie Jiřího Karáska připomímná významného českého básníka a zpřístupňuje bohatství jeho výtvarné sbírky, kterou spravuje Památník národního písemnictví. Prezentuje téměř 300 děl všech druhů, žánrů a období: obrazy, kresby, grafiky ale i plastiky.">
    <meta property="og:type" content="website" />
    <meta property="og:author" content="http://lab.sng.sk/" />
    <meta property="og:url" content="https://karasek.pamatniknarodnihopisemnictvi.cz" />
    <meta property="og:image" content="https://karasek.pamatniknarodnihopisemnictvi.cz/img/og-image.jpg" />
    <meta property="og:site_name" content="Virtuální galerie Jiřího Karáska ze Lvovic" />

    <title>Virtuální galerie Jiřího Karáska ze Lvovic</title>

    <link rel="preload" href="/fonts/Ayer-Medium-Web.woff2?4d9e29854dacd915df5594a8e2186884" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="/fonts/Ermina.woff?9f7d1bbbcf839db384b88ec79a458dfb" as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload" href="/fonts/Ermina-Medium.woff?4752de02c382db6e62fe8a69f9a452e1" as="font" type="font/woff" crossorigin="anonymous">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @if(App::environment('production'))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-182651670-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-182651670-1');
    </script>
    @endif
</head>
<body class="antialiased font-serif leading-relaxed p-5 lg:px-32 lg:py-10 lg:text-lg tracking-wide {{ $bodyClasses ?? '' }}">
    <div id="app">
        @yield('content')
    </div>

    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
</body>
</html>
