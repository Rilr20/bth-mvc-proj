@extends('layout/main')
@section('title', $title ?? "no title")
@section('content')
    <h1>Admin</h1>
    <div class="admin-div">
    <a class="new" href="{{url("/blog/create")}}">Nytt Inlägg &rarr;</a>
    @foreach ($blogs as $blog)
        <div class="blog-data">
            <p>Id: {{$blog->id}}</p>
            <p>Titel: {{$blog->header}}</p>
            <p>Skribent: {{$blog->author}}</p>
            <p>Publiseringsdatum: {{$blog->published}}</p>
            <p>Är synlig: </p>
            <p>Borttaget: {{$blog->deleted_at}}</p>
            
            <a class="edit" href="{{url("/blog/$blog->id/edit")}}">Ändra</a>
            {{-- <a href="{{url("/blog/$blog->id")}}">Radera</a> --}}
            @if ($blog->deleted_at == null)
                <form class="" action="{{url("/blog/$blog->id")}}" method="POST" >
                    @csrf
                    @method('delete')
                        <button class="delete" type="submit">
                            Radera
                        </button>
                </form>
            @endif

        </div>
        @endforeach
    </div>
@endsection