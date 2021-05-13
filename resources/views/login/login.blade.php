@extends('layout/main')
@section('title', $title ?? "no title")
@php
    $wrong = $wrong ?? null;
@endphp
@section('content')
<h1>Nytt Blogginlägg</h1>
    <div class="login-form">
        <div class="error">
            <p>{{$wrong}}</p>
        </div>
        <form action="{{url('/login/checklogin')}}" method="POST">
            @csrf
            <div class="form-input">
                <label>Användarnamn</label>
                <input type="text" name="username" placeholder="" required>
            </div>
            <div class="form-input">
                <p>Lösenord</p>
                <input type="password" name="password" placeholder="" required>
            </div>
            <button type="submit" class="submit-button">Logga In</button>
        </form>
    </div>
    <a href="{{ url('/login/logout') }}">Logout</a>
@endsection