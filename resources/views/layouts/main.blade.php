<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>@section('title')Страница @show</title>

</head>
<body>

<header class="pb-5">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="{{ asset('/') }}">НОВОСТИ</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="#navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @yield('menu')


        <div class="collapse navbar-collapse flex justify-content-md-end" id="navbarNavDropdown">
            <ul class="navbar-nav  font-weight-bolder my-2">

                @isset($authorizedUserInfo)
                    <li class="nav-item">
                        <h5 class="nav-link pb-0 mb-0 font-weight-bolder text-success pr-4">

                            @if($authorizedUserInfo['role'] == 'admin')
                                <a class="text-decoration-none text-success"
                                   href="{{ route('admin.show', 0) }}">{{ $authorizedUserInfo['email'] }}</a>
                            @else
                                {{ $authorizedUserInfo['email'] }}
                            @endif

                        </h5>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.logout') }}">Выход</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.reg') }}">Регистрация</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.login') }}">Вход</a>
                    </li>
                @endisset
            </ul>
        </div>

    </nav>

</header>

<main id="app" class="container mt-5 mb-2">

    @yield('content')

</main>

<footer class="footer navbar navbar-expand-md navbar-dark bg-dark">
    @include('layouts.footer')
</footer>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
