@extends('layout/main')
@section('title', $title ?? "no title")
@section('content')
<h1>Mumintrollets Blog</h1>
    <a href="{{url("/blog/admin")}}">Admin</a>
    <div class="all-blog-items">
        <div class="example-blog preview-blog">
            <h2 class="preview-header">Fejkinlägg</h2>
            <div class="image-text">
                <img class="preview-img" src="{{ asset('img/3fc66a7.jpg')}}" alt="">
                <p class="preview-text">preview text om vad inlägget handlar om lite saker och ting kan vara bra att veta om man vill läsa. Mer om inlägget så kan man klicka på h2:an som tar en ti wegha wekglhawjklghawjkleg hawjkle hgalwke g...</p>
            </div>
            <p class="preview-footer">2021-05-11 20:20</p>
        </div>
        @foreach ($blogs as $blog)
            <div class="example-blog preview-blog">
            <h2 class="preview-header"><a href="{{url("/blog/$blog->id")}}">{{$blog->header}}</a></h2>
            <div class="image-text">
                <img class="preview-img" src="{{ asset("img/$blog->image_one.jpg") }}" alt="{{$blog->image_one}}">
                <p class="preview-text">
                    @php
                        $shorten = substr($blog->bodytext,0, 200);
                        echo $shorten . "...";
                        
                    @endphp
                </p>
            </div>
            <p class="preview-footer">{{$blog->published}}</p>
        </div>
        @endforeach
    </div>
@endsection