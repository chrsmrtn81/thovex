<!DOCTYPE html>
<html lang='{{ str_replace('_', '-', app()->getLocale()) }}'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title>@yield('title', 'Thovex')</title>

    <script src='https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places'></script>
    <script src='{{ mix('js/app.js') }}' defer></script>
    <link rel='stylesheet' href='{{ mix('css/app.css') }}'>
</head>

<body>
    <main id='app'>
        @yield('content')
    </main>
</body>

</html>
