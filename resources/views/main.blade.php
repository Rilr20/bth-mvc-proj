<!DOCTYPE html>
<html lang="en">
<!-- kalla inte på denna i web.php -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Document - @yield('title')</title>

</head>

<body>
    <nav class="nav">
        <ul>
            <li><a href="{{url('/')}}">Home</a></li>
            <li><a href="{{url('/hello-world-view')}}">Hello World View</a></li>
            <li><a href="{{url('/hello-world')}}">Game 21</a></li>
            <li><a href="{{url('/hello-world')}}">Yatzy</a></li>
        </ul>
    </nav>
    <main class="main">
        @yield('content')
    </main>
    <footer class="footer">
        <hr>
        <p>FooterText</p>
    </footer>
</body>

</html>