<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
</head>

<body>
    <!--================ Start Header Menu Area =================-->
    @include('includes.navbar')
    <!--================ End Header Menu Area =================-->
    @yield('content')
    <!--================ Start footer Area  =================-->
    @include('includes.footer')
    <!--================ End footer Area  =================-->
    @include('includes.script')
</body>

</html>