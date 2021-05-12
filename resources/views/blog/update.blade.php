@extends('layout/main')
@section('title', $title ?? "no title")
@section('content')
<h1>Nytt Blogginlägg</h1>
    <div class="blog-create-form">
        <form action="{{url("/blog/$blog->id") }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-input">
                <label>Header</label>
                <input type="text" name="header"  value="{{$blog->header}}" placeholder="Skriv titel..." required>
            </div>
            <div class="form-input">
                <p>Brödtexten</p>
                <textarea name="bodytext"  cols="30" rows="10"  placeholder="Skriv brödtexten..." required>{{$blog->bodytext}} </textarea>
            </div>
            <div class="form-input">
                <label>Bilder</label>
                <input type="text" name="image_one"  value="{{$blog->image_one}}" placeholder="bild 1">
                <input type="text" name="image_two"  value="{{$blog->image_two}}" placeholder="bild 1">
            </div>
            <div class="form-input">
                <label>Skribent</label>
                <input type="text" name="author"  value="{{$blog->author}}" placeholder="Skribent...">
            </div>
            <div class="form-input">
                <label>Publiseringstiden</label>
                <input type="text" value="{{$blog->published}}" name="published">
            </div>
            <div class="form-input div-button">
                {{-- <input type="submit" value="Skapa"> --}}
                <button type="submit" class="submit-button">Skapa inlägg</button>
            </div>
        </form>
    </div>
@endsection