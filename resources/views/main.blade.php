<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css') }}/main.css">
        <title>Страница приветствия</title>
    </head>

    <div class='container'>
    @if(session('user'))
        @include('headerForUsers')
    @elseif(session('admin'))
        @include('headerForAdmin')
    @else
        @include('header')
    @endif

        <body>
            @yield('content')
        </body>

        @include('footer')
    </div>

</html>