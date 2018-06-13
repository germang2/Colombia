<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shared;

class SharedController extends Controller{

  private function ipdir(){
    if(getenv('HTTP_CLIENT_IP')){
      $ip = getenv('HTTP_CLIENT_IP');
    }elseif(getenv('HTTP_X_FORWARDED_FOR')){
      $ip = getenv('HTTP_X_FORWARDED_FOR');
    }elseif(getenv('HTTP_X_FORWARDED')){
      $ip = getenv('HTTP_X_FORWARDED');
    }elseif(getenv('HTTP_FORWARDED_FOR')){
      $ip = getenv('HTTP_FORWARDED_FOR');
    }elseif(getenv('HTTP_FORWARDED')){
      $ip = getenv('HTTP_FORWARDED');
    }else{
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }

  public function insert($articulo, $user, $type){
    $ip = self::ipdir();
    Shared::create(['article' => $articulo, 'user' => $user, 'type' => $type, 'ip' => $ip]);
    return redirect('/articulo/'.$articulo);
  }
}
