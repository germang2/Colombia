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

  public function shared(Request $request) {
    $req = $request->all();
    $id_article = $req["id_article"];
    $id_user = $req["id_user"];
    $social_red = $req["social_red"];
    $social_red_accepted = ["whatsapp", "facebook", "twitter"];
    // Check if social red is not accepted
    if (!in_array($social_red, $social_red_accepted)) {
      return response()->json([
        'message'=>"Red social invalida",
        'data'=>[]
      ],400);
    }
    if (Shared::where('article', $id_article)->where("type", $social_red)->where('user', $id_user)->first()) {
      $shared = Shared::where('article', $id_article)->where("type", $social_red)->where('user', $id_user)->first();
      $shared->shared += 1;
      $shared->left -= 1;
      $shared->save();
      $message="Datos actualizados con éxito";
      return response()->json([
        'message'=>$message,
        'data'=>[]
      ],200);
    } else {
      try {
        if ($id_user){

          Shared::create([
            "article"=>$id_article,
            "user"=>$id_user,
            "type"=>$social_red,
            "shared"=>1,
            "left"=>199
            ]);
        } else {
            
          Shared::create([
            "article"=>$id_article,
            "type"=>$social_red,
            "shared"=>1,
            "left"=>199
          ]);
        }
            
          $message = "Nuevo registro de articulo compartido creado";
          return response()->json([
            'message'=>$message,
            'data'=> []
          ], 201);
        } catch(Exception $e) {
          $message = "Error en los datos recibidos";
          return response()->json([
            'message'=>$message,
            'data'=> []
          ], 400);
        }
      }
  }
}
