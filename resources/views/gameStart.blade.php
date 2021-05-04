@extends('layout/main')
@section('title', $title ?? "no title")

@section('content')
<h1> {{ $header }} </h1>
<p> {{ $message }}</p>

<p>Play with 1 or 2 dice?</p>
<form action="{{ url('/game') }}" method="post">
    @csrf
    <button class="game-button" name="gameAction" type="submit" value="1">1 Die</button>
    <button class="game-button" name="gameAction" type="submit" value="2">2 Dice</button>
</form>
@stop