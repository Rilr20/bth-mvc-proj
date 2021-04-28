@extends('layout/main')
@section('title', $title ?? "no title")
@php
    $tabledata = $tabledata ?? null;
    $computerDice = $computerDice ?? null;
    $playerDice = $playerDice ?? [];
    $throws = $_SESSION["throws"] ?? null;
    $throws = 3 - $throws;
@endphp
@section('content')
<h1>{{$header}}</h1>
<p>{{$message}}</p>
<p>Yatzy som fan</p>

<div class="yatzy-box">
        <table>
            <tr>
                <th></th>
                <th>Player</th>
                <th>Computer</th>
            </tr>
            {!! html_entity_decode($tabledata) !!}
        </table>
    </div>

<form action="{{ url('/highscore') }}" method="POST">
    @csrf
    
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="username...">
        <input type="hidden" name="totalscore" value="{{$totalScore}}" id="">
        <button type="submit">Submit score</button>
</form>

@stop