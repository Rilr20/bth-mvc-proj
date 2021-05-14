<!DOCTYPE html>
<html lang="en">
<!-- kalla inte på denna i web.php -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-small.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <title>Document - @yield('title')</title>

</head>

<body>
    <header>
        <div class="hero-image" style="background-image: url({{asset('/img/milkyway.jpg')}});">
        </div>
        <nav class="nav">
            <ul class="site-links">
                <li class="{{Request::path() == "/" ? 'active' : ''}}"><a href="{{url('/')}}">Startsidan</a></li>
                <li class="{{Request::path() == "hello-world-view" ? 'active' : ''}}"><a href="{{url('/hello-world-view')}}">Hello World View</a></li>
                <li class="{{Request::path() == "dice" ? 'active' : ''}}"><a href="{{url('/dice')}}">Tärning</a></li>
                <li class="{{Request::path() == "game" ? 'active' : ''}}"><a href="{{url('/game')}}">Game 21</a></li>
                <li class="{{Request::path() == "yatzy" ? 'active' : ''}}"><a href="{{url('/yatzy')}}">Yatzy</a></li>
                <li class="{{Request::path() == "highscore" ? 'active' : ''}}"><a href="{{url('/highscore')}}">Highscore</a></li>
                <li class="{{Request::path() == "book" ? 'active' : ''}}"><a href="{{url('/book')}}">Books</a></li>
                <li class="{{Request::path() == "blog" ? 'active' : ''}}"><a href="{{url('/blog')}}">Blogg</a></li>
            </ul>
            <ul class="login-links">
                @if (Auth::user())
                    <li>Inloggad som: {{Auth::user()->username}}</li>
                    <li><a href="{{url('/login/logout')}}">Logga Ut</a></li>    
                @else
                    <li  class="{{Request::path() == "login" ? 'active' : ''}}"><a href="{{url('/login')}}">Logga In</a></li>
                @endif
            </ul>
        </nav>
    </header>  
    <main class="main">
        @yield('content')
    </main>
    <footer class="footer">
        <p>Sidan är skapad av Rikard {{date('Y')}}&#169;</p>
    </footer>
</body>

</html>