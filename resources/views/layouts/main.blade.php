<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ $title }}</title>
</head>

<body>

<div id="app" class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="{{ asset('/') }}">hello</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ asset('/news') }}">news</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ asset('/about') }}">about</a>
        </li>
    </ul>

    <div class="content">
        @yield('content')
    </div>

</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
