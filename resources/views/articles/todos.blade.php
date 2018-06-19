@extends('layouts.app')
@section('content')
<div class="columns is-multiline">
  @foreach($articles as $article)
    <div class="column is-3">
      <div class="card">
        <div class="card-image">
          <figure class="image is-2by1">
            <img src="https://img.youtube.com/vi/{{$article->video}}/mqdefault.jpg">
            
          </figure>
        </div>
        <div class="card-content">
          <div class="content">
            <strong>
              <h6 class="title is-6">{{ $article->title }}</h6>
            </strong>
            <time datetime="2016-1-1">{{ $article->date }}</time>
          </div>
        </div>
        <footer class="card-footer">
          <a href="/articulo/{{ $article->id }}" class="card-footer-item">Leer artículo</a>
        </footer>
      </div>
    </div>
  @endforeach
</div>
@endsection
