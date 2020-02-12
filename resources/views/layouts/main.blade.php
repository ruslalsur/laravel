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

<header class="pb-5">
    @include('layouts.header')
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
