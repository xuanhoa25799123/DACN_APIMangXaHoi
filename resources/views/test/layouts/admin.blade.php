<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    @yield('title')
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('/css/sidebar.css')}}">
     <link rel="stylesheet" href="{{asset('/css/toggle-sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('/css/header.css')}}">
    <link rel="stylesheet" href="{{asset('/css/content.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/bootstrap-css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    @yield('css')
</head>
<body>
<div class="big-container">
    <div class="left">
    @include('test.partials.sidebar')
    </div>
    <div class="right">
          @include('test.partials.toggle-sidebar')
    @include('test.partials.header')

    <div class="content">

    @yield('content')
        </div>
    </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/js/test/main.js')}}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

@yield('js')
</body>
</html>
