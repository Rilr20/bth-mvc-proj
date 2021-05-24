@extends('layout/main')
@section('title', $title ?? "no title")
@section('content')
<h1>Nytt Blogginlägg</h1>
    <div class="blog-create-form">
        <form action="{{url('/blog') }}" method="POST">
            @csrf
            <div class="input-div">
                <label class="label">Header</label>
                <input class="input" type="text" name="header" placeholder="Skriv titel..." required>
            </div>
            <div class="input-div">
                <label class="label">Brödtexten</label>
                <textarea class="textarea"  name="bodytext"  cols="30" rows="10" placeholder="Skriv brödtexten..." required></textarea>
            </div>
            <div class="input-div">
                <label class="label">Bilder</label>
                <input class="input" type="text" name="image_one" placeholder="bild 1">
                <input class="input" type="text" name="image_two" placeholder="bild 1">
            </div>
            <div class="input-div">
                <label class="label">Skribent</label>
                <input class="input" type="text" name="author" placeholder="Skribent..." required>
            </div>
            <div class="input-div">
                <label class="label">Tid det ska publiserat om tom publiseras det nu</label>
                <input class="input" type="date" name="published-date" value="{{now()}}">
                <input class="input" type="time" name="published-time" value="{{now()}}">
            </div>
            <div class="form-input div-button">
                {{-- <input type="submit" value="Skapa"> --}}
                <button type="submit" class="login-button">Skapa inlägg</button>
            </div>
        </form>
    </div>
@endsection