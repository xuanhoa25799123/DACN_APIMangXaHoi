<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @yield('title')
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
{{--    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">--}}
    @yield('css')
</head>
<body>
    @yield('content')

{{--<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>--}}

<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

{{--<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>--}}
@yield('js')
</body>
</html>
