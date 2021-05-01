@extends('layout.main')

@section('content')
<h1 class="center">Yatzy Highscore</h1>
<div>
    
    {{-- <table class="highscores"> --}}
        {{-- <tr> --}}
            {{-- <th></th> --}}
            {{-- <th>Usernamne</th> --}}
            {{-- <th>Points</th> --}}
            {{-- <th>Date</th> --}}
        {{-- </tr> --}}
    {{-- @foreach ($highscore as $hs) --}}
        {{-- <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$hs->username}}</td>
            <td>{{$hs->score}}</td>
            <td>{{$hs->achieved}}</td>
        </tr> --}}
    {{-- @endforeach --}}
    {{-- @for ($i = count($highscore) + 1; $i <= 10; $i++)
        <tr>
            <td>{{$i}}</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    @endfor --}}
    {{-- </table> --}}

    <div class="highscore">
        <div class="highscore-header">
            <p>Placement</p>
            <p>Username</p>
            <p>Points</p>
            <p>Date</p>
        </div>
        @foreach ($highscore as $hs)
            <div class="highscore-item" style="width: {{100-$loop->iteration}}%">
                <p>{{$loop->iteration}}</p>
                <p>{{$hs->username}}</p>
                <p>{{$hs->score}}</p>
                <p>{{$hs->achieved}}</p>
            </div>
        @endforeach
        @for ($i = count($highscore) + 1; $i <= 10; $i++)
         <div class="highscore-item empty" style="width: {{100-$i}}%">
                <p>{{$i}}</p>
                <p></p>
                <p></p>
                <p></p>
            </div>
    @endfor
    </div>
</div>
@endsection
