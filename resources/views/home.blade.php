@extends('layouts.app')

@section('content')

@if (session('status'))
  <h1>
    {{ session('status') }}
  </h1>
@endif

<h1 class="title">
  Estadisticas
</h1>
<p class="subtitle">
  De actividad
</p>

<div class="columns">
  <div class="column is-one-quarter">
    <aside class="menu box">
      <p class="menu-label">
        Últimos artículos
      </p>
      <ul class="menu-list">
        @foreach($articles as $article)
          <li><a href="/articulo/{{ $article->id }}">{{ $article->name }}</a></li>
        @endforeach
      </ul>
    </aside>
  </div>
  <div class="column is-three-quarter">
    <div class="box">
      <!--estadisticas-->
      <nav class="level">
        <div class="level-item has-text-centered">
          <div>
            <p class="heading">Referidos</p>
            <p class="title">{{ $referidos }}</p>
          </div>
        </div>
        <div class="level-item has-text-centered">
          <div>
            <p class="heading">Articulos publicados</p>
            <p class="title">{{ $publicados }}</p>
          </div>
        </div>
        <div class="level-item has-text-centered">
          <div>
            <p class="heading">Enlaces compartidos</p>
            <p class="title">{{ $compartidos }}</p>
          </div>
        </div>
        <div class="level-item has-text-centered">
          <div>
            <p class="heading">Enlaces visitados</p>
            <p class="title">{{ $visitados }}</p>
          </div>
        </div>
      </nav>
      <!--estadisticas-->
    </div>
  </div>
</div>


@endsection
