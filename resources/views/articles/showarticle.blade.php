@extends('layouts.app')
@section('head')
<link rel="stylesheet" href="{{asset('css/style.css')}}">



@endsection
@section('content')
<h1 class="title">
  {{ $article->title }}
</h1>
  <iframe width="700" height="450" src="https://www.youtube.com/embed/{{$article->video}}" frameborder="0" allow="encrypted-media" allowfullscreen>
  </iframe>
<p>
  <strong>{{$article->date}}</strong>
</p>
<p>
    {{ $article->content }}
</p>
<p>Visto: {{$article->seen}}</p>
@endsection
