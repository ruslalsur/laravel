<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>@section('title')Страница @show</title>

</head>
<body>

<header class="pb-5">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="text-primary navbar-brand font-weight-bolder {{ request()->routeIs('home') ? 'active' : "" }}"
           href="{{ route('home') }}">НОВОСТИ</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="#navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @yield('menu')

        <div class="collapse navbar-collapse flex justify-content-md-end" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.login') }}">{{ __('Войти') }}</a>
                    </li>
                    @if (Route::has('auth.register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.register') }}">{{ __('Регистрация') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img class="rounded border border-light p-1 mr-2" src="{{ Auth::user()->avatar }}"
                                 alt="{{ Auth::user()->avatar }}" width="50" height="50">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('auth.logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Выйти') }}
                            </a>

                            <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>

<main id="app" class="container mt-4 py-4">
    @if(session('success'))
        <div class="mt-2 alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('failure'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('failure') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @yield('content')

</main>

<footer class="footer navbar navbar-expand-md navbar-dark bg-dark">
    @include('layouts.footer')
</footer>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
