<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <title>Management Info</title>

        <!-- Global stylesheets -->
        <link href="{{asset('global_assets/fonts/inter/inter.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('global_assets/icons/phosphor/styles.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('assets/css/ltr/all.min.css')}}" id="stylesheet" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script src="{{asset('global_assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
        <!-- /core JS files -->

        <!-- Theme JS files -->
        <script src="{{asset('assets/js/app.js')}}"></script>
        <!-- /theme JS files -->

        <!-- App JS -->
        @vite('resources/js/app.js')
    </head>

    <body id="app">

    </body>
</html>
