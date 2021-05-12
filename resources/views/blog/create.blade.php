@extends('layout/main')
@section('title', $title ?? "no title")
@section('content')
<h1>Nytt Blogginlägg</h1>
    <div class="blog-create-form">
        <form action="{{url('/blog') }}" method="POST">
            @csrf
            <div class="form-input">
                <label>Header</label>
                <input type="text" name="header" placeholder="Skriv titel..." required>
            </div>
            <div class="form-input">
                <p>Brödtexten</p>
                <textarea name="bodytext"  cols="30" rows="10" placeholder="Skriv brödtexten..." required></textarea>
            </div>
            <div class="form-input">
                <label>Bilder</label>
                <input type="text" name="image_one" placeholder="bild 1">
                <input type="text" name="image_two" placeholder="bild 1">
            </div>
            <div class="form-input">
                <label>Skribent</label>
                <input type="text" name="author" placeholder="Skribent...">
            </div>
            <div class="form-input">
                <label>Tid det ska publiserat om tom publiseras det nu</label>
                <input type="date" name="published-date" value="{{now()}}">
                <input type="time" name="published-time" value="{{now()}}">
            </div>
            <div class="form-input div-button">
                {{-- <input type="submit" value="Skapa"> --}}
                <button type="submit" class="submit-button">Skapa inlägg</button>
            </div>
        </form>
    </div>
@endsection