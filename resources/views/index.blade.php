<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Acción Colombia') }}</title>
    <link rel="stylesheet" href="{{asset('css/bulma.css')}}">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
  </head>
  <body>
    <section class="hero is-fullheight has-bg-img">
      <div class="hero-body">
        <div class="container">
          <div class="columns is-centered is-vcentered">
            <div class="column is-narrow">
              <div>
                <h1 class="title">
                  Bienvenido
                </h1>
                <h2 class="subtitle">
                  Nos alegra tenerte aquí
                </h2>
                @if (Route::has('login'))
                  @auth
                    <a class="button is-link" href="{{ url('/home') }}">Mi perfil</a>
                  @else
                    <a class="button is-link" href="{{ route('login') }}">Iniciar Sesión</a>
                    <a class="button is-link" href="{{ route('register') }}">Unirme</a>
                  @endauth
                @endif
                    <a class="button is-danger" href="/articulos">Artículos</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @if(isset($mensaje))
      <script>
        alert('{{ $mensaje }}')
      </script>
    @endif
  </body>
</html>
