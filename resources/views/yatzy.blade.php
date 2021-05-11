@extends('layout/main')
@section('title', $title ?? "no title")
@php
    $tabledata = $tabledata ?? null;
    $computerDice = $computerDice ?? null;
    $playerDice = $playerDice ?? [];
    $throws = Session::get("throws") ?? null;
    $throws = (3 - $throws);
@endphp
@section('content')
<h1>{{$header}}</h1>
<p>{{$message}}</p>
<p>Yatzy som fan</p>

<form action="{{ url('/yatzy') }}" method="POST">
    @csrf
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
    <div class="dice-box player">
        @foreach ($playerDice as $dice)
            <div class="dice-input">
                {!! html_entity_decode($dice) !!}
                {!! html_entity_decode( "<input type='checkbox' name='chosenDice[]' value='" .  substr_count($dice, "<span class='dot'></span>") . "'>") !!}
                {!! html_entity_decode( "<input type='hidden' name='Dice[]' value=" .  substr_count($dice, "<span class='dot'></span>") . "'>") !!}
            </div>
            {{-- @@php
                echo "<input type='checkbox' name='chosenDice[]' value='" .  substr_count($die, "<span class='dot'></span>") . "'>";
                echo "<input type='hidden' name='Dice[]' value=" .  substr_count($die, "<span class='dot'></span>") . "'>";
            @endphp --}}
        @endforeach        

    </div>
    <div class="dice-box">
        {{ $computerDice }}
    </div>
    <h1> {{$throws}} throws left</h1>

    <button class="game-button" value="roll" name="gameaction">Throw Dice</button>

    @if ($playerDice != null)
        <button class="game-button" value="reroll" name="gameaction">Reroll Dice</button>
        <button class="game-button" value="confirm" name="gameaction">Add to array</button>
    @endif
</form>

@stop