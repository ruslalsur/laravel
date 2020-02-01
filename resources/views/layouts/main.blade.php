<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <style>
        .menu > a {
            color: #636b6f;
            margin-right: 25px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            text-transform: uppercase;
            outline: none;
            display: inline-flex;
            transition: transform 250ms
        }

        a:hover {
            color: red;
            transform: scale(1.15)
        }

        a:active {
            color: red;
            transform: scale(1)
        }

        .hello {
            font-size:36pt;
            color: green;
        }

        .news {
            font-size:36pt;
            color: red;
        }

        .about {
            font-size:36pt;
            color: blue;
        }
    </style>
</head>

<body>

<div class="menu">
    <a href="/">hello</a>
    <a href="/news">news</a>
    <a href="/about">about</a>
</div>

@yield('content')

</body>
</html>
