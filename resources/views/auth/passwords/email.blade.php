@extends('layouts.app')
@section('head')
<script>
  function cerrar() {
      document.getElementById('noti').style.display = 'none';
  }
</script>
@endsection
@section('content')
<div class="columns is-centered is-vcentered">
  <div class="column is-4">
    <div class="box">
      <h1 class="title">
        Recuperar Contraseña
      </h1>
      <p class="subtitle">
        Escribe tu correo electrónico
      </p>
      @if (session('status'))
        <div class="notification is-success" id="noti">
          <a href="javascript:cerrar();" class="delete"></a>
          {{ session('status') }}
        </div>
      @endif
      <form class="" action="{{ route('password.email') }}" method="post">
        @csrf
        <div class="field">
          <div class="control has-icons-left">
            <input id="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus>
            <span class="icon is-small is-left">
              <i class="fas fa-envelope"></i>
            </span>
          </div>
          @if ($errors->has('email'))
            <p class="help is-danger">{{ $errors->first('email') }}</p>
          @endif
        </div>
        <!--Aquí-->
        <div class="field">
          <div class="control">
            <button type="submit" class="button is-link">Enviar instrucciones</button>
          </div>
        </div>
        <!--Aquí-->
      </form>
    </div>
  </div>
</div>
@endsection
