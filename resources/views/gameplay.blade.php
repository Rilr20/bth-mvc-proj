@extends('layout/main')
@section('title', $title ?? "no title")

@section('content')
<h1> {{ $header }} </h1>
<p> {{ $message }}</p>

<h3>Computer: {{ $computerSum }} </h3>
<div class="dice-box">
    @foreach ($computerDice as $dice)
    {!! html_entity_decode($dice) !!}
    @endforeach
</div>
<h3>Player: {{ $playerRoll }}</h3>
<div class="dice-box">
    @foreach ($playerDice as $dice)
    {!! html_entity_decode($dice) !!}
    @endforeach

</div>

<form action="{{ url('/game') }}" method="post">
    @csrf
    <button class="game-button" type="submit" name="gameAction" value="roll" />Roll</button>
    <input type="hidden" name="computer" value="{{ $computerSum }}">
    <input type="hidden" name="player" value=" {{ $playerRoll }}">
    @php
    Session::put("computerDice", serialize($computerDice));
    @endphp
    <button class="game-button" type="submit" name="gameAction" value="stay" />Stay</button>
</form>
@stop