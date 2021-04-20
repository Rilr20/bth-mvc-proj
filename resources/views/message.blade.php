@extends('layout/main')
@section('title', $title ?? "no title")
@section('content')
<p>The message is:</p>
<p>{{ $message }}</p>
@endsection