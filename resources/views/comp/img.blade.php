@extends('layouts.app')
@section('content')
<div class="columns is-centered is-vcentered">
  <div class="column is-8">
    <div class="box">
      <h1 class="title">
        Generador de imagenes
      </h1>
      <p class="">
        Escribe tu nombre y comparte tu imagen con tus contactos. Comparte en tus redes sociales, envía por whatsapp a tus enlaces e invita a 10 personas a que también hagan su propia imagen. Pasa la voz, demostremos que apoyamos el cambio contra de la corrupción.
      </p>
      <br>
      <!--input-->
      <div class="field">
        <div class="control has-icons-left">
          <input id="nombrepersona" type="text" class="input" name="name" placeholder="escribe tu nombre" maxlength="21" required autofocus>
          <span class="icon is-small is-left">
            <i class="fas fa-user"></i>
          </span>
        </div>
      </div>
      <!--input-->
      <div class="field">
        <div class="control has-icons-left">
          <div class="select is-fullwidth">
            <select id="imagenselect">
              <option selected value="" disabled>Elige un fondo</option>
              <option value="1">Imagen 1</option>
              <option value="2">Imagen 2</option>
              <option value="3">Imagen 3</option>
            </select>
          </div>
          <div class="icon is-small is-left">
            <i class="fas fa-image"></i>
          </div>
        </div>
      </div>
      <!--input-->
      <a class="button is-link" id="generarimagen" onclick="textChangeListener()">Generar imagen</a>
      <a class="button is-success" id="guardar" style="display: none" download="imagen.png">Descargar</a>
      <!--botones-->
      <br>
      <br>
      <img src="{{asset('im/generador/petropresidente.png')}}" alt="petropresidente" id="imageninicial">
      <canvas id="canvas" width="800" height="800" download="petropresidente" style="display: none">
      </canvas>
      <!--imagen y canvas-->
    </div>
  </div>
</div>
<!--JS-->
<br>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
@endsection

@section('foot')
<script type="text/javascript">
    $(document).ready(function(){
        $('#imagenselect').on("change", function(){
            var value = this.value;
            var imagenname = "{{asset('im/generador')}}/";
            if (value == 1) {
                imagenname = imagenname + "petropresidente.png";
            } else if (value == 2) {
                imagenname = imagenname + "fondo2.jpg";
            } else if (value == 3) {
                imagenname = imagenname + "fondo3.jpg";
            }
            document.getElementById("canvas").setAttribute("style", "display:none");
            document.getElementById("guardar").setAttribute("style", "display:none");
            document.getElementById("imageninicial").setAttribute("style", "");
            document.getElementById("imageninicial").setAttribute("src", imagenname);
        });
    });
</script>

<script type="text/javascript">

    function textChangeListener () {
      document.getElementById("imageninicial").setAttribute("style", "display:none");
      document.getElementById("guardar").setAttribute("style", "");
      document.getElementById("canvas").setAttribute("style", "");
      window.lineName = document.getElementById('nombrepersona').value;
      window.lineName = window.lineName.toUpperCase();
      var imagen = document.getElementById("imageninicial");
      redrawMeme(imagen, window.lineName);
      $('#guardar').attr('href',document.getElementById('canvas').toDataURL());
      $('#guardar').removeClass('hidden');
    }

    function redrawMeme(imagen, topLine) {

      var canvas = document.querySelector('canvas');
      var ctx = canvas.getContext("2d");
      var imagen = document.getElementById("imageninicial");
      if (imagen != null)
        ctx.drawImage(imagen, 0, 0, canvas.width, canvas.height);

      // Atributos del texto
      ctx.font = '60pt Impact';
      ctx.textAlign = 'center';
      ctx.strokeStyle = '#662583';
      ctx.lineWidth = 0;
      ctx.fillStyle = '#662583';

      if (topLine != null) {
        ctx.fillText(topLine, canvas.width / 2, 320);
        ctx.strokeText(topLine, canvas.width / 2,320);
      }
    }

    function saveFile() {
       window.open(document.querySelector('canvas').toDataURL());

    }

    $('document').ready(function(e){

      var image = document.getElementById("imageninicial");
      redrawMeme(image,null);

    });



  //  document.querySelector('button').addEventListener('click', saveFile, false);
</script>
@endsection
