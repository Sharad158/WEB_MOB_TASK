<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ URL::asset('resources/uploads/logo/fav.png')}}" />

    <title>{{ config('app.name', 'Laravel') }}</title>


    @include('layouts.css')
    @yield('css')
</head>
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    @yield('content')
    @include('layouts.js')
    @yield('script')
</body>
</html>
