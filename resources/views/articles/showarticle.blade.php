@extends('layouts.app')
@section('head')
<link rel="stylesheet" href="{{asset('css/style.css')}}">



@endsection
@section('content')
<h1 class="title">
  {{ $article->title }}
</h1>
  <iframe width="420" height="315"
    src="https://www.youtube.com/watch?v=m76gOnBj31Y">
  </iframe> 
<p>
  <strong>{{$article->date}}</strong>
</p>
<p>
    {{ $article->content }}
</p>
<p>Visto: {{$article->seen}}</p>
@endsection
