@extends('layout.main')

@section('content')
<h1 class="center">Yatzy Highscore</h1>
<div class="book-items">
    
    <table class="highscores">
        <tr>
            <th></th>
            <th>Användarnamn</th>
            <th>Poäng</th>
            <th>Datum</th>
        </tr>
    @foreach ($highscore as $hs)
        
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$hs->username}}</td>
            <td>{{$hs->score}}</td>
            <td>{{$hs->achieved}}</td>
        </tr>
    @endforeach
    </table>
</div>
@endsection