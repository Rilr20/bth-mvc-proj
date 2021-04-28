@extends('layout.main')

@section('content')
<h1>Highscore Listan</h1>
<div class="book-items">
    
    <table class="highscores">
        <tr>
            <th>Username</th>
            <th>Score</th>
            <th>Achieved</th>
        </tr>
    @foreach ($highscore as $hs)
        <tr>
            <td>{{$hs->username}}</td>
            <td>{{$hs->score}}</td>
            <td>{{$hs->achieved}}</td>
        </tr>
    @endforeach
    </table>
</div>
@endsection