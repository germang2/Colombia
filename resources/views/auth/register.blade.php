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
    <div class="box">
      <h1 class="title">
        Formulario de registro
      </h1>
      <p class="subtitle">
        Diligencia todos los campos
      </p>
      <form name="frm" class="" action="{{ route('register') }}" method="post">
        @csrf
        <div class="field">
          <div class="control has-icons-left">
            <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" placeholder="Nombres" value="{{ old('name') }}" maxlength="100" required autofocus>
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
            <input id="lastname" type="text" class="input{{ $errors->has('lastname') ? ' is-danger' : '' }}" name="lastname" placeholder="Apellidos" value="{{ old('lastname') }}" maxlength="100" required>
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
          <div class="control has-icons-left">
            <input id="phone" class="input{{ $errors->has('phone') ? ' is-danger' : '' }}" type="number" name="phone" placeholder="Teléfono" value="{{ old('phone') }}" maxlength="30" required>
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
          <div class="control has-icons-left">
            <input id="godfather" type="text" class="input{{ $errors->has('godfather') ? ' is-danger' : '' }}" name="godfather" placeholder="Código de quien lo refirió (Opcional)" value="{{ old('godfather') }}" maxlength="23">
            <span class="icon is-small is-left">
              <i class="fas fa-tag"></i>
            </span>
          </div>
          @if ($errors->has('godfather'))
            <p class="help is-danger">{{ $errors->first('godfather') }}</p>
          @endif
        </div>
        <!--Aquí-->
        <div class="field">
          <div class="control has-icons-left">
            <input id="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
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
          <div class="control has-icons-left">
            <input id="password-confirm" class="input" type="password" name="password_confirmation" placeholder="Repetir Contraseña" required>
            <span class="icon is-small is-left">
              <i class="fas fa-key"></i>
            </span>
          </div>
        </div>
        <!--Aquí-->
        <div class="field">
          <div class="control">
            <button type="submit" class="button is-link">Unirme</button>
          </div>
        </div>
        <!--Aquí-->
        <div class="field is-grouped">
          <div class="box has-text-centered">
            <a href="{{ route('social.auth', 'facebook') }}">Ingresa con Facebook</a>
          </div>
        </div>
        <!--Aquí-->
      </form>
    </div>
  </div>
</div>
@endsection
