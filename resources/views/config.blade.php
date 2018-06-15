@extends('layouts.app')
@section('head')
<script language="JavaScript">

function addOpt(oCntrl, iPos, sTxt, sVal){
var selOpcion=new Option(sTxt, sVal);
eval(oCntrl.options[iPos]=selOpcion);
}

function cambia(oCntrl){
switch (document.frm.state.selectedIndex){
case 0:
break;
@foreach($states as $state)
  case {{ $state->id }}:
    var position = -1;
    @foreach($cities as $city)
      @if($city->state == $state->id)
        position = position + 1;
        addOpt(oCntrl, position, "{{ $city->name }}", "{{ $city->id }}");
      @endif
    @endforeach
  break;
@endforeach
}
}
</script>

<script>
  function persona() {
    document.getElementById('persona').style.display = '';
    document.getElementById('contacto').style.display = 'none';
    document.getElementById('pass').style.display = 'none';

    document.getElementById('a').classList.add('is-active');
    document.getElementById('b').classList.remove('is-active');
    document.getElementById('c').classList.remove('is-active');
  }
  function contacto() {
    document.getElementById('persona').style.display = 'none';
    document.getElementById('contacto').style.display = '';
    document.getElementById('pass').style.display = 'none';

    document.getElementById('a').classList.remove('is-active');
    document.getElementById('b').classList.add('is-active');
    document.getElementById('c').classList.remove('is-active');
  }
  function pass() {
    document.getElementById('persona').style.display = 'none';
    document.getElementById('contacto').style.display = 'none';
    document.getElementById('pass').style.display = '';

    document.getElementById('a').classList.remove('is-active');
    document.getElementById('b').classList.remove('is-active');
    document.getElementById('c').classList.add('is-active');
  }
</script>
@endsection
@section('content')
<div class="columns is-centered is-vcentered">
  <div class="column is-narrow">
    <div class="box">
      <h1 class="title">
        Configuración
      </h1>
      <p class="subtitle">
        Actualizar Información
      </p>
      <div class="tabs">
        <ul>
          <li class="is-active" id="a"><a href="javascript:persona();">Datos personales</a></li>
          <li id="b"><a href="javascript:contacto();">Datos de contacto</a></li>
          <li id="c"><a href="javascript:pass();">Ubicación</a></li>
        </ul>
      </div>
      <!--Secciones-->
      <div class="" id="persona">
        <form class="" action="/config/personal" method="post">
          @csrf
          <div class="field">
            <div class="control has-icons-left">
              <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" placeholder="Nombres" value="{{ $user->name }}" maxlength="100" required autofocus>
              <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
            </div>
            @if ($errors->has('name'))
              <p class="help is-danger">{{ $errors->first('name') }}</p>
            @endif
          </div>
          <!--Aquí-->
          <div class="field">
            <div class="control has-icons-left">
              <input id="lastname" type="text" class="input{{ $errors->has('lastname') ? ' is-danger' : '' }}" name="lastname" placeholder="Apellidos" value="{{ $user->lastname }}" maxlength="100" required>
              <span class="icon is-small is-left">
                <i class="fas fa-user"></i>
              </span>
            </div>
            @if ($errors->has('lastname'))
              <p class="help is-danger">{{ $errors->first('lastname') }}</p>
            @endif
          </div>
          <!--Aquí-->
          <div class="field">
            <div class="control">
              <button type="submit" class="button is-link">Actualizar</button>
            </div>
          </div>
        </form>
      </div>
      <!--Secciones-->
      <div class="" id="contacto" style="display:none;">
        <form class="" action="/config/contacto" method="post">
          @csrf
          <div class="field">
            <div class="control has-icons-left">
              <input id="phone" class="input{{ $errors->has('phone') ? ' is-danger' : '' }}" type="number" name="phone" placeholder="Teléfono" value="{{ $user->phone }}" maxlength="30" required>
              <span class="icon is-small is-left">
                <i class="fas fa-phone"></i>
              </span>
            </div>
            @if ($errors->has('phone'))
              <p class="help is-danger">{{ $errors->first('phone') }}</p>
            @endif
          </div>
          <!--Aquí-->
          <div class="field">
            <div class="control">
              <button type="submit" class="button is-link">Actualizar</button>
            </div>
          </div>
        </form>
      </div>
      <!--Secciones-->
      <div class="" id="pass" style="display:none;">
        <form class="" name="frm" action="/config/city" method="post">
          @csrf
          <!--Aquí-->
          <div class="field">
            <div class="control has-icons-left">
              <div class="select is-fullwidth">
                <select name="state" onchange="cambia(document.frm.city)" required>
                  <option selected value="" disabled>-Departamento-</option>
                  @foreach($states as $state)
                    <!--Option que restaura estado antiguo del departamento, desactivado porque la misma función no se puede aplicar al municipio-->
                    <!--<option value="{{ $state->id }}" {{ old('state') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>-->
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="icon is-small is-left">
                <i class="fas fa-globe"></i>
              </div>
            </div>
          </div>
          <!--Aquí-->
          <div class="field">
            <div class="control has-icons-left">
              <div class="select is-fullwidth">
                <select name="city" required>
                  <option selected value="" disabled>-Municipio-</option>
                </select>
              </div>
              <div class="icon is-small is-left">
                <i class="fas fa-home"></i>
              </div>
            </div>
          </div>
          <!--Aquí-->
          <div class="field">
            <div class="control">
              <button type="submit" class="button is-link">Actualizar</button>
            </div>
          </div>
        </form>
      </div>
      <!--Secciones-->
    </div>
    <div class="box">
      <form class="" action="config/testigo" method="post">
        @csrf
        <!--Aquí-->
        <div class="field">
          <div class="control has-icons-left">
            <div class="select is-fullwidth">
              <select name="witness" required>
                <option selected value="" disabled>-¿Es testigo electoral?-</option>
                <option value="0">No</option>
                <option value="0">Si</option>
              </select>
            </div>
            <div class="icon is-small is-left">
              <i class="fas fa-sticky-note"></i>
            </div>
          </div>
        </div>
        <!--aquí-->
        <div class="field">
          <div class="control">
            <button type="submit" class="button is-link">Unirme</button>
          </div>
        </div>
        <!--aquí-->
      </form>
    </div>
  </div>
</div>
@endsection
