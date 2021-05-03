<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="url" content="https://zalo-app-api.herokuapp.com">
    @yield('title')
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('/css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('/css/header.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/bootstrap-css/bootstrap.min.css')}}">
    {{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">--}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    @yield('css')
</head>
<body>
<div class="big-container">
    <div class="left">
        @include('social.partials.sidebar')
    </div>
    <div class="right">
        @include('social.partials.header')
        <div class="content">
            @yield('content')
        </div>
    </div>
</div>
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>--}}
<script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/js/main.js')}}"></script>
<script src="{{asset('/js/menu-dropdown.js')}}"></script>
{{--<script src="{{asset('/js/refresh-token.js')}}"></script>--}}

@yield('js')
</body>
</html>
