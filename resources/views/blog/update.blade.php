@extends('layout/main')
@section('title', $title ?? "no title")
@section('content')
<h1>Nytt Blogginlägg</h1>
    <div class="blog-create-form">
        <form action="{{url("/blog/$blog->id") }}" method="POST">
            @csrf
            @method('PUT')
            <div class="input-div">
                <label class="label">Header</label>
                <input class="input" type="text" name="header"  value="{{$blog->header}}" placeholder="Skriv titel..." required>
            </div>
            <div class="input-div">
                <label class="label">Brödtexten</label>
                <textarea class="textarea" name="bodytext"  cols="30" rows="10"  placeholder="Skriv brödtexten..." required>{{$blog->bodytext}} </textarea>
            </div>
            <div class="input-div">
                <label class="label">Bilder</label>
                <input class="input" type="text" name="image_one"  value="{{$blog->image_one}}" placeholder="bild 1">
                <input class="input" type="text" name="image_two"  value="{{$blog->image_two}}" placeholder="bild 1">
            </div>
            <div class="input-div">
                <label class="label">Skribent</label>
                <input class="input" type="text" name="author"  value="{{$blog->author}}" placeholder="Skribent...">
            </div>
            <div class="input-div">
                <label class="label">Publiseringstiden</label>
                <input class="input" type="text" value="{{$blog->published}}" name="published">
            </div>
            <div class="form-input div-button">
                {{-- <input class="input" type="submit" value="Skapa"> --}}
                <button type="submit" class="login-button">Skapa inlägg</button>
            </div>
        </form>
    </div>
@endsection