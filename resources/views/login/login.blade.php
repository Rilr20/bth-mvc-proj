@extends('layout/main')
@section('title', $title ?? "no title")
@php
    $wrong = $wrong ?? null;
@endphp
@section('content')
<div class="login-form">
        <h1 class="center">Logga In</h1>
        <div class="error">
            <p class="center red">{{$wrong}}</p>
        </div>
        <form class="login-form" action="{{url('/login/checklogin')}}" method="POST">
            @csrf
            <div class="input-div">
                <input class="input" type="text" name="username" placeholder="username" required>
            </div>
            <div class="input-div">
                <input class="input" type="password" name="password" placeholder="password" required>
            </div>
            <button type="submit" class="login-button" >Logga In</button>
        </form>
    </div>
@endsection