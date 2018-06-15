@extends('layouts.app')
@section('content')
<div class="columns is-centered">
  <div class="column is-9">

    <div class="box">
      <div class="columns is-centered is-vcentered">
        <div class="column is-narrow">
          @yield('encabezado')
        </div>
      </div>
      @yield('text')
    </div>
  </div>
  <div class="column is-3">

      @if(Auth::check())
      <div class="card">
        <div class="card-content">
          <div class="media">
            <div class="media-left">
              <figure class="image is-48x48">
                <img src="{{asset('im/user.png')}}">
              </figure>
            </div>
            <div class="media-content">
              <p class="title is-4">{{ $user->name }}</p>
              <p class="subtitle is-6">Comparte</p>
            </div>
          </div>

          <div class="content">
            Puedes compartir esta información con tus amigos a través de facebook, twitter y Whatsapp. <strong>Comparte ahora, es facil y rapido</strong>
            <br>
            <br>
            <div class="share-buttons-row">
        			<div class="share-fb"></div>
        			<div class="share-twitter"></div>
        			<div class="share-whats"></div>
        		</div>
          </div>
        </div>
      </div>
      <br>
      @else
      <div class="notification box">
        <a class="button is-link" href="/login">Compartir artículo</a>
      </div>
      @endif
    <aside class="menu box">
      <p class="menu-label">
        Otros artículos
      </p>
      <ul class="menu-list">
        @foreach($articles as $article)
          <li><a href="/articulo/{{ $article->id }}">{{ $article->name }}</a></li>
        @endforeach
      </ul>
    </aside>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="{{asset('js/functions.js')}}"></script>
@endsection
