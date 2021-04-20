@extends('layout/main')
@section('title', $title ?? "no title")
@section('content')
<div class="content">
    <h1>Välkommen till min laravelsida :D</h1>
    <p>Där jag fattar typ vad som händer men ändå inte</p>
    <img class="bild" src="{{ asset('img/3fc66a7.jpg') }}" alt="bild på något roligt">
    <p>katt med kaninöron</p>
</div>
@stop