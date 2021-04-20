@extends('layout/main')
@section('title', $title ?? "no title")
@section('content')
<h1>The Result is: {{ $result }}</h1>
<form method="POST" action="{{ url('/dice') }}">
    @csrf
    <button class="button" type="submit">Rulla</button>
</form>

@stop