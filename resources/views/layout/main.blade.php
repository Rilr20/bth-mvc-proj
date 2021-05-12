<!DOCTYPE html>
<html lang="en">
<!-- kalla inte på denna i web.php -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-small.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>Document - @yield('title')</title>

</head>

<body>
    <nav class="nav">
        <ul>
            <li><a href="{{url('/')}}">Startsidan</a></li>
            <li><a href="{{url('/hello-world-view')}}">Hello World View</a></li>
            <li><a href="{{url('/dice')}}">Tärning</a></li>
            <li><a href="{{url('/game')}}">Game 21</a></li>
            <li><a href="{{url('/yatzy')}}">Yatzy</a></li>
            <li><a href="{{url('/highscore')}}">Highscore</a></li>
            <li><a href="{{url('/book')}}">Books</a></li>
            <li><a href="{{url('/blog')}}">Blog</a></li>
        </ul>
    </nav>
    <main class="main">
        @yield('content')
    </main>
    <footer class="footer">
        <p>FooterText</p>
    </footer>
</body>

</html>