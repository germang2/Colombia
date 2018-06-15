<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Acción Colombia') }}</title>
    <link rel="stylesheet" href="{{asset('css/bulma.css')}}">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    @yield('head')
  </head>
  <body>
    <nav class="navbar is-link">
      <div class="navbar-brand">
        <a class="navbar-item" href="{{ url('/') }}">
          <img src="{{asset('im/logo.png')}}" width="100" height="50">
        </a>
        <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>

      <div id="navbarExampleTransparentExample" class="navbar-menu">
        <div class="navbar-start">
          <a class="navbar-item" href="/img">
            Generador de imagenes
          </a>
          <a class="navbar-item" href="/reporte">
            Reportes E-14
          </a>
          <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">
              Artículos
            </a>
            <div class="navbar-dropdown is-boxed">
              <a class="navbar-item" href="/articulos">
                Ver todos
              </a>
            </div>
          </div>
        </div>

        <div class="navbar-end">
          <div class="navbar-item">
            <div class="field is-grouped">
              @guest
                <p class="control">
                  <a class="button is-light" href="{{ route('login') }}">
                    <span class="icon">
                      <i class="fas fa-user"></i>
                    </span>
                    <span>
                      Inicia sesión
                    </span>
                  </a>
                </p>
                <p class="control">
                  <a class="button is-light" href="{{ route('register') }}">
                    <span class="icon">
                      <i class="fas fa-user-plus"></i>
                    </span>
                    <span>
                      Unete
                    </span>
                  </a>
                </p>
              @else
                <div class="navbar-item has-dropdown is-hoverable">
                  <a class="navbar-link" href="">
                    {{ Auth::user()->name }}
                  </a>
                  <div class="navbar-dropdown is-boxed">
                    <a class="navbar-item" href="/home">
                      Panel
                    </a>
                    <a class="navbar-item" href="/perfil">
                      Perfil
                    </a>
                    <a class="navbar-item" href="/config">
                      Configuración
                    </a>
                    <hr class="navbar-divider">
                    <a class="navbar-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </div>
                </div>
              @endguest
            </div>
          </div>
        </div>
      </div>
    </nav>
    <section class="section">
      <div class="container">
        @yield('content')
      </div>
    </section>
    <footer class="footer">
      <div class="container">
        <div class="content has-text-centered">
          <p>
            <a href="https://www.accioncolombia.com.co/">Acción Colombia</a> - <strong>&copy; 2018</strong>
            - <a href="/privacidad">política de Privacidad</a>
          </p>
        </div>
      </div>
    </footer>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        // Get all "navbar-burger" elements
        var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {
          // Add a click event on each of them
          $navbarBurgers.forEach(function ($el) {
            $el.addEventListener('click', function () {
              // Get the target from the "data-target" attribute
              var target = $el.dataset.target;
              var $target = document.getElementById(target);
              // Toggle the class on both the "navbar-burger" and the "navbar-menu"
              $el.classList.toggle('is-active');
              $target.classList.toggle('is-active');
            });
          });
        }
      });
    </script>
  </body>
</html>
@yield('foot')
