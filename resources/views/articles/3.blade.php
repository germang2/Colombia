@extends('layouts.article')
@section('head')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<!--Tags para compartir-->
<meta name="description" content="Se conoció un reporte técnico preliminar de la ONU en el que se indica que la presa está en riesgo">
<meta name="author" content="Acción Colombia">
<meta property="og:locale" content="es_ES"/>
<meta property="og:type" content="article"/>
<meta property="og:title" content="La ONU sobre Hidroituango"/>
<meta property="og:description" content="Se conoció un reporte técnico preliminar de la ONU en el que se indica que la presa está en riesgo"/>
<!--<meta property="og:url" content="http://www.accioncolombiadigital.com/"/>-->
<!--<meta property="og:site_name" content="accioncolombiadigital.com"/>-->
<!--<meta property="article:publisher" content=""/>-->
<!--<meta property="article:published_time" content="2018-06-08"/>-->
<meta property="og:image" itemprop="image" content="{{asset('im/art/3/face.jpg')}}"/>
@if(Auth::check())
  <script>
    var user = {{ $user->id }};
    var article = 1;
  </script>
@endif
@endsection
@section('encabezado')
<h1 class="title">
  ‘Datos del reporte de la ONU no están actualizados’: EPM
</h1>
<p>
  <strong>8 de junio</strong> de 2018
</p>
<figure class="image is-2by1">
  <img src="{{asset('im/art/3/portada.jpg')}}">
</figure>
@endsection
@section('text')
<p>
  Las alarmas alrededor del proyecto Hidroituango se encendieron de nuevo tras un reporte técnico preliminar, del 1.° de junio, presentado por la ONU.
“La parte superior de la presa (relleno prioritario) fue diseñada y construida en emergencia, que constituye un punto débil que si falla puede conducir a una ruptura de la presa”, se lee en uno de los apartes del reporte (revelado por Blu Radio).
De acuerdo con el estudio de ingenieros de la ONU, el diseño del relleno prioritario no cumple con prácticas estándar. Esta situación elevaría el riesgo de fracturación hidráulica de la capa de arcilla.
</p>
<br>
<p>
  Si bien la ONU aclaró que no es un estudio definitivo, entre los hallazgos se registró que hay contaminación de filtros en la presa y vertedero, “y que no hay un tratamiento adecuado del contacto entre el núcleo de arcilla y el estribo (la roca no está recortada, la capa de hormigón lanzado está agrietada). Si el núcleo de arcilla no funciona correctamente y el relleno se satura, la presa no es estable”.
En lo referente a la montaña, se reveló que hay una fuerte debilitación del interior del macizo rocoso (en torno a las obras hidromecánicas: túneles, casa de máquinas), además de inestabilidad de la ladera y riesgo de deslizamiento dentro del embalse.
Sobre el tema, Luis Javier Vélez, vicepresidente de proyectos de generación de energía de EPM, indicó que los datos del reporte no están actualizados pese a lo reciente del informe.
“Ellos (ONU) no pudieron ver el avance definitivo del lleno prioritario. Cuando realizaron la visita, los trabajos no tenían el avance actual”, dijo Vélez. De hecho, la visita de la ONU para la realización del informe fue el 18 de mayo.
El directivo de EPM argumentó que el informe también indica que la presa no contaba con protección del enrocado, algo que era cierto en el momento de la visita.
Sin embargo, desde que se llegó a la cota 410, ya tiene este elemento de protección “y cumple perfectamente con el propósito”
</p>
@endsection
