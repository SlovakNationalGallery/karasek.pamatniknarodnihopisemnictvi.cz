<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Virtuální galerie Jiřího Karáska ze Lvovic</title>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="antialiased font-serif leading-relaxed p-5 lg:p-10 lg:text-lg tracking-wide {{ $bodyClasses ?? '' }} {{ !empty($fullHeight) ? 'min-h-full' : '' }}">
    <div id="app" class="{{ !empty($fullHeight) ? 'min-h-full' : '' }}">
        @yield('content')
    </div>

    <script type="text/javascript" src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
