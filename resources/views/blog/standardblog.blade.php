@extends('layout/main')
@section('title', $title ?? "no title")
@section('content')
<h1>Mumintrollets Blog</h1>

    <div class="full-blog ">
            <div class="text-blog">
            <h2 class="blog-header">{{$blog->header}}</h2>
            <div class="blog-standard">
                <img class="blog-img" src="{{ asset("img/$blog->image_one.jpg") }}" alt="{{$blog->image_one}}">
                <p class="full-text blog-standard-text">
                    {{$blog->bodytext}}
                </p>
            </div>
            <p class="preview-footer">publiserat: {{$blog->published}} av: {{$blog->author}}</p>
        </div>
    </div>
@endsection