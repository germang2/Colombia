@extends('layouts.article')
@section('head')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<!--Tags para compartir-->
<meta name="description" content="Íngrid Torres, tenía 39 años y rodó a un abismo de unos 700 metros">
<meta name="author" content="Acción Colombia">
<meta property="og:locale" content="es_ES"/>
<meta property="og:type" content="article"/>
<meta property="og:title" content="Atleta murio en el cañon de Chicamocha"/>
<meta property="og:description" content="Íngrid Torres, tenía 39 años y rodó a un abismo de unos 700 metros"/>
<!--<meta property="og:url" content="http://www.accioncolombiadigital.com/"/>-->
<!--<meta property="og:site_name" content="accioncolombiadigital.com"/>-->
<!--<meta property="article:publisher" content=""/>-->
<!--<meta property="article:published_time" content="2018-06-08"/>-->
<meta property="og:image" itemprop="image" content="{{asset('im/art/1/face.jpg')}}"/>
@if(Auth::check())
  <script>
    var user = {{ $user->id }};
    var article = 1;
  </script>
@endif
@endsection
@section('encabezado')
<h1 class="title">
  ¿Qué pasó con atleta muerta en Chicamocha?
</h1>
<p>
  <strong>8 de junio</strong> de 2018
</p>
<figure class="image is-2by1">
  <img src="{{asset('im/art/1/portada.jpg')}}">
</figure>
@endsection
@section('text')
<p>
  La atleta, antropóloga de profesión y oriunda de Ipiales, Nariño, se había desplazado hasta San Gil para participar en la modalidad de 75 kilómetros de la carrera. <strong>Desde el domingo, cuando terminó la competición, estaba desaparecida.</strong>
</p>
<br>
<p>
  Torres había empezado su participación en la carrera a las 6 de la mañana del domingo, y en la noche no había llegado a la meta, como estaba planeado. En ese momento se inició su búsqueda, que culminó este lunes sobre las 3 de la tarde con la lamentable noticia.
</p>
<br>
<p>
  Algunas de sus pertenencias y documentos fueron encontrados en la zona rural del municipio de Aratoca y poco después fue localizado el cuerpo en el abismo.
  En los trabajos para rescatar el cuerpo participan miembros de la Defensa Civil y los bomberos locales, aunque la dificultad del terreno y el peligro que representa no han permitido terminar la labor.
</p>
@endsection
