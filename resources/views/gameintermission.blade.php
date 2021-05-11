@extends('layout/main')
@section('title', $title ?? "no title")
@section('content')
<h1> {{ $header }} </h1>
<p> {{ $gameText }}</p>
<h3>Computer: {{ $computerSum }} </h3>
<div class="dice-box">
    @foreach ($computerDice as $dice)
    {!! html_entity_decode($dice) !!}
    @endforeach
</div>
<h3>Player: {{ $playerRoll }}</h3>

@php
if (isset($gameText)) {
echo "<h3>Score History</h3>";
echo "<ul>";
    foreach (Session::get("resultArray") as $result) {
    echo "<li>" . $result . "</li>";
    }
    echo "</ul>";
}
@endphp

<form action="{{ url('/game') }}" method="post">
    @csrf
    <button class="game-button" name="gameAction" , type="submit" value="reset">Reset</button>
    <button class="game-button" name="gameAction" , type="submit" value="resetscore">Reset Score</button>
</form>

@stop