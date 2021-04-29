@extends('layout.main')

@section('content')
<h1 class="center">Yatzy Highscore</h1>
<div>
    
    <table class="highscores">
        <tr>
            <th></th>
            <th>Usernamne</th>
            <th>Points</th>
            <th>Date</th>
        </tr>
    @foreach ($highscore as $hs)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$hs->username}}</td>
            <td>{{$hs->score}}</td>
            <td>{{$hs->achieved}}</td>
        </tr>
    @endforeach
    @for ($i = count($highscore) + 1; $i <= 10; $i++)
        <tr>
            <td>{{$i}}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endfor
    </table>
</div>
@endsection
