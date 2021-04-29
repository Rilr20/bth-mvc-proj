@extends('layout.main')

@section('content')
<h1>Böcker</h1>
<div class="book-items">
    
    @foreach ($books as $book)
        <div class="item">
            <div class="information">
                <p> {{$book->title}}, År: {{$book->published}} </p>
                <p> {{ $book->author }}</p>
                <p>ISBN: {{ $book->isbn }}</p>
            </div>
            <img class="book-cover" src="{{ asset("img/$book->image.jpg") }}" alt="{{$book->title}}">
        </div>
    @endforeach
</div>
@endsection