<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hasSection('head')
            @yield('head')
        @else
            <link rel="stylesheet" href="../resources/css/main.css">
        @endif
        <title>Страница приветствия</title>
    </head>

    @hasSection('header')
        @yield('header')
    @else
        @include('header')
    @endif

    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>

    @include('footer')

</html>