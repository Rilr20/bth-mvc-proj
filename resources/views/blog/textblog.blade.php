@extends('layout/main')
@section('title', $title ?? "no title")
@section('content')
<h1>Mumintrollets Blog</h1>

    <div class="full-blog ">
            <div class="text-blog">
            <h2 class="blog-header">{{$blog->header}}</h2>
            <div class="blog-text">
                <p class="full-text">
                    {{$blog->bodytext}}
                </p>
            </div>
            <p class="preview-footer">{{$blog->published}}</p>
        </div>
    </div>
@endsection