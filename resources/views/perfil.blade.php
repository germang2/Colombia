@extends('layouts.app')

@section('content')
<div class="columns is-centered is-vcentered">
  <div class="column is-4">
    <div class="box">
      <h5 class="title is-5">{{ $user->name }} {{ $user->lastname }}</h5>
      <h6 class="subtitle is-6">  <strong>Codigo: </strong>{{ $user->code }}</h6>
      <article class="media">
        <figure class="media-left">
          <figure class="image is-64x64">
            <img src="{{asset('im/user.png')}}">
          </figure>
        </figure>
        <div class="media-content">
          <div class="content">
            <p>
              <strong>{{ $user->email }}</strong> - <small>{{ $user->phone }}</small>
              <br>
              <strong>registrado sesde: </strong>{{ $user->created_at }}
              <br>
              <strong>ciudad: </strong>{{ $user->ciudad->name }}
              <br>
              @if(!$user->godfather)
                <strong>Referido por: </strong>Ninguno
              @else
                <strong>Referido por: </strong>{{ $user->padrino->name }} {{ $user->padrino->lastname }}
              @endif
            </p>
          </div>
        </div>
      </article>
    </div>
  </div>
</div>
@endsection
