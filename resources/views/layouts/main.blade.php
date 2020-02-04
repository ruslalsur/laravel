<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/my-styles.css">
    <title>{{$title}}</title>
</head>

<body>

<div class="menu">
    <a href="/">hello</a>
    <a href="/news">news</a>
    <a href="/about">about</a>
</div>

@yield('content')

<script src="js/my-js.js"></script>
</body>
</html>
