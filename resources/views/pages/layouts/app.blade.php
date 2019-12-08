<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.app_title') }}</title>

        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

        <style>
            body {
                padding-top: 5rem;
            }
        </style>

    </head>
    <body>

        @include('pages.inc.navbar')

        <div class="container">
            @include('pages.inc.msg')
            @yield('content')
        </div>


        <script src="{{ asset('bootstrap/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    </body>
</html>
