@extends('layout/main')
@section('title', $title ?? "no title")
@section('content')
<h1>Mumintrollets Blog</h1>

    <div class="full-blog ">
        <div class="text-blog">
            <h2 class="blog-header">{{$blog->header}}</h2>
            <div class="blog-standard">
                
                <img class="blog-img-one" src="{{ asset("img/$blog->image_one.jpg") }}" alt="{{$blog->image_one}}">
                <div class="double-img">
                    <p class="full-text blog-double-text">
                        <img class="blog-img-two" src="{{ asset("img/$blog->image_one.jpg") }}" alt="{{$blog->image_two}}">
                        {{$blog->bodytext}}
                    </p>
                </div>
            </div>
            <div class="blog-footer">
                <p class="blog-footer-text">publiserat: {{$blog->published}}</p>
                <p class="blog-footer-text">av: {{$blog->author}}</p>
            </div>
        </div>
    </div>
@endsection