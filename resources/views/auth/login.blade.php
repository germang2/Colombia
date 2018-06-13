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
    @if (session('confirmation-success'))
      <div class="notification is-success" id="noti">
        <a href="javascript:cerrar();" class="delete"></a>
        {{ session('confirmation-success') }}
      </div>
    @endif
    @if (session('confirmation-danger'))
      <div class="notification is-danger" id="noti">
        <a href="javascript:cerrar();" class="delete"></a>
        {!! session('confirmation-danger') !!}
      </div>
    @endif
    <div class="box">
      <h1 class="title">
        Iniciar Sesión
      </h1>
      <p class="subtitle">
        Escribe tu correo y contraseña
      </p>
      <form class="" action="{{ route('login') }}" method="post">
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
          <div class="control has-icons-left">
            <input id="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" type="password" name="password" placeholder="Contraseña" required>
            <span class="icon is-small is-left">
              <i class="fas fa-key"></i>
            </span>
          </div>
          @if ($errors->has('password'))
            <p class="help is-danger">{{ $errors->first('password') }}</p>
          @endif
        </div>
        <!--Aquí-->
        <div class="field">
          <div class="control">
            <label class="checkbox">
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
              Recuérdame
            </label>
          </div>
        </div>
        <!--Aquí-->
        <div class="field is-grouped">
          <div class="control">
            <button type="submit" class="button is-link">Entrar</button>
          </div>
          <div class="control">
            <a href="{{ route('password.request') }}">Olvidaste tu contraseña?</a>
          </div>
        </div>
        <!--Aquí-->
      </form>
    </div>
  </div>
</div>
@endsection
