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
      <form name="frm" class="" action="/reporte/registro" method="post">
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
          <div class="control has-icons-left">
            <input id="zona" class="input{{ $errors->has('zona') ? ' is-danger' : '' }}" type="number" name="zona" placeholder="zona" value="{{ old('zona') }}" maxlength="5" required>
            <span class="icon is-small is-left">
              <i class="fas fa-globe"></i>
            </span>
          </div>
          @if ($errors->has('zona'))
            <p class="help is-danger">{{ $errors->first('zona') }}</p>
          @endif
        </div>
        <!--Aquí-->
        <div class="field">
          <div class="control has-icons-left">
            <input id="puesto" class="input{{ $errors->has('puesto') ? ' is-danger' : '' }}" type="text" name="puesto" placeholder="puesto" value="{{ old('puesto') }}" maxlength="200" required>
            <span class="icon is-small is-left">
              <i class="fas fa-map-marker-alt"></i>
            </span>
          </div>
          @if ($errors->has('puesto'))
            <p class="help is-danger">{{ $errors->first('puesto') }}</p>
          @endif
        </div>
        <!--Aquí-->
        <div class="field">
          <div class="control has-icons-left">
            <input id="mesa" class="input{{ $errors->has('mesa') ? ' is-danger' : '' }}" type="number" name="mesa" placeholder="mesa" value="{{ old('mesa') }}" maxlength="4" required>
            <span class="icon is-small is-left">
              <i class="fas fa-pencil-alt"></i>
            </span>
          </div>
          @if ($errors->has('mesa'))
            <p class="help is-danger">{{ $errors->first('mesa') }}</p>
          @endif
        </div>
        <!--Aquí-->
        <div class="field">
          <div class="control has-icons-left">
            <input id="duque" class="input{{ $errors->has('duque') ? ' is-danger' : '' }}" type="number" name="duque" placeholder="Votos por Ivan Duque" value="{{ old('duque') }}" maxlength="4" required>
            <span class="icon is-small is-left">
              <i class="fas fa-piggy-bank"></i>
            </span>
          </div>
          @if ($errors->has('duque'))
            <p class="help is-danger">{{ $errors->first('duque') }}</p>
          @endif
        </div>
        <!--Aquí-->
        <div class="field">
          <div class="control has-icons-left">
            <input id="petro" class="input{{ $errors->has('petro') ? ' is-danger' : '' }}" type="number" name="petro" placeholder="Votos por Gustavo Petro" value="{{ old('petro') }}" maxlength="4" required>
            <span class="icon is-small is-left">
              <i class="fas fa-piggy-bank"></i>
            </span>
          </div>
          @if ($errors->has('petro'))
            <p class="help is-danger">{{ $errors->first('petro') }}</p>
          @endif
        </div>
        <!--Aquí-->
        <div class="field">
          <div class="control has-icons-left">
            <input id="blanco" class="input{{ $errors->has('blanco') ? ' is-danger' : '' }}" type="number" name="blanco" placeholder="Votos en blanco" value="{{ old('blanco') }}" maxlength="4" required>
            <span class="icon is-small is-left">
              <i class="fas fa-piggy-bank"></i>
            </span>
          </div>
          @if ($errors->has('blanco'))
            <p class="help is-danger">{{ $errors->first('blanco') }}</p>
          @endif
        </div>
        <!--Aquí-->
        <div class="field">
          <div class="control has-icons-left">
            <input id="nulo" class="input{{ $errors->has('nulo') ? ' is-danger' : '' }}" type="number" name="nulo" placeholder="Votos nulos" value="{{ old('nulo') }}" maxlength="4" required>
            <span class="icon is-small is-left">
              <i class="fas fa-piggy-bank"></i>
            </span>
          </div>
          @if ($errors->has('nulo'))
            <p class="help is-danger">{{ $errors->first('nulo') }}</p>
          @endif
        </div>
        <!--Aquí-->
        <div class="field">
          <div class="control has-icons-left">
            <input id="total" class="input{{ $errors->has('total') ? ' is-danger' : '' }}" type="number" name="total" placeholder="Total de votos" value="{{ old('total') }}" maxlength="4" required>
            <span class="icon is-small is-left">
              <i class="fas fa-piggy-bank"></i>
            </span>
          </div>
          @if ($errors->has('total'))
            <p class="help is-danger">{{ $errors->first('total') }}</p>
          @endif
        </div>
        <!--Aquí-->
        <div class="field">
          <div class="control">
            <button type="submit" class="button is-link">Registrar</button>
          </div>
        </div>
        <!--Aquí-->
      </form>
    </div>
  </div>
</div>
@endsection
