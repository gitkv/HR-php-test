<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}"/>
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script src="{{ asset('/js/script.js') }}" defer></script>

    <title>Тестовое задание</title>
</head>
<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Тестовое задание</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="@linkIsActive('weather')">
                    <a href="{{route('weather', ['cityName' => "брянск"])}}">Погода в Брянске</a>
                </li>
                <li class="@linkIsActive('orders')">
                    <a href="#">Заказы</a>
                </li>
                <li class="@linkIsActive('products')">
                    <a href="#">Продукты</a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    @yield('content')
</div>
</body>
</html>