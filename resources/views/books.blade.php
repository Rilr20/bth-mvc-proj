@extends('layout.main')

@section('content')
<h1>Bokhandel</h1>
<div class="book-items">
    
    @foreach ($books as $book)
        <div class="item">
            <p> {{$book->title}} </p>
            <p> {{ $book->author }}</p>
            <p>ISBN: {{ $book->isbn }}</p>
            <p>BILD:</p>
            <hr>
        </div>
    @endforeach
</div>
@endsection