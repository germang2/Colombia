@extends('layouts.article')
@section('head')
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<!--Tags para compartir-->
<meta name="description" content="El Parque Tecnológico de Guatiguará es uno de los más modernos centros de cómputo del país">
<meta name="author" content="Acción Colombia">
<meta property="og:locale" content="es_ES"/>
<meta property="og:type" content="article"/>
<meta property="og:title" content="Silicon Valey en Colombia"/>
<meta property="og:description" content="El Parque Tecnológico de Guatiguará es uno de los más modernos centros de cómputo del país"/>
<!--<meta property="og:url" content="http://www.accioncolombiadigital.com/"/>-->
<!--<meta property="og:site_name" content="accioncolombiadigital.com"/>-->
<!--<meta property="article:publisher" content=""/>-->
<!--<meta property="article:published_time" content="2018-06-08"/>-->
<meta property="og:image" itemprop="image" content="{{asset('im/art/2/face.jpg')}}"/>
@if(Auth::check())
  <script>
    var user = {{ $user->id }};
    var article = 1;
  </script>
@endif
@endsection
@section('encabezado')
<h1 class="title">
  El Silicon Valley colombiano estará en Piedecuesta, Santander
</h1>
<p>
  <strong>8 de junio</strong> de 2018
</p>
<figure class="image is-2by1">
  <img src="{{asset('im/art/2/portada.jpg')}}">
</figure>
@endsection
@section('text')
<p>
  El Parque Tecnológico de Guatiguará, proyecto urbanístico, tecnológico y empresarial de la Universidad Industrial de Santander (UIS), se convirtió en uno de los más modernos del país, de acuerdo con testimonios de expertos y varias entidades.
En sus predios funcionan 14 centros de investigación que trabajan con el sector productivo nacional y están próximas a instalarse las dos primeras empresas de base tecnológica que darán inicio al componente empresarial del proyecto.
El escenario es especialmente adaptado para propiciar el trabajo de desarrollos tecnológicos y su aplicación a la producción de bienes y servicios, potenciando los proyectos para ser competitivos en mercados nacionales e internacionales.
</p>
<br>
<p>
  En Guatiguará funcionará el Centro Colombiano de Computación Avanzada, el único en el país que permitiría el desarrollo de proyectos tecnológicos innovadores.
“El proyecto se consolida como el más importante de Colombia que contará con altos estándares científicos y tecnológicos para atender soluciones empresariales en la región para que Santander se convierta en un territorio referente de la tecnología e innovación, como lo es Silicon Valley, un lugar epicentro de la ciencia en el mundo”, dijo Jaime Alberto Camacho Pico, investigador y coordinador del Parque Tecnológico.
Por su parte, los impactos más sobresalientes en el departamento obedecen a la generación de nuevas empresas, competitividad y empleo.
</p>
@endsection
