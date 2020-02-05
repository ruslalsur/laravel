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
    <nav class="navbar navbar-expand-sm navbar-light bg-faded">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content"
                aria-controls="nav-content" aria-expanded="false" aria-label="Переключатель навигации">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Бренд -->
        <a class="navbar-brand" href="{{ asset('/') }}">@{{ message }}</a>
        <!-- Ссылки -->
        <div class="collapse navbar-collapse" id="nav-content">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('/') }}">hello</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('/news') }}">news<span class="sr-only">(текущая)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ asset('/about') }}">about</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content">
        @yield('content')
    </div>

</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
