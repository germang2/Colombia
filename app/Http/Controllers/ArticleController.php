<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use App\Link;
use Auth;

class ArticleController extends Controller{

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

  public function todos(){
    $very = Auth::check();
    if($very){
      $user = Auth::user();
    }else{
      $user = 0;
    }
    $articles = Article::orderBy('created_at','desc')->paginate(20);
    return view('articles.todos', ['articles' => $articles, 'user' => $user]);
  }

  public function article($articulo){
    $very = Auth::check();
    if($very){
      $user = Auth::user();
    }else{
      $user = 0;
    }
    $articles = Article::orderBy('created_at','desc')->take(10)->get();
    return view('articles.'.$articulo, ['articles' => $articles, 'user' => $user]);
  }


  public function registro($articulo, $user, $origen){
    $very = Auth::check();
    if($very){
      $user = Auth::user();
    }else{
      $user = intval($user);
      $origen = intval($origen);
      if($user > 0 and ($origen > 0 or $origen < 4)){
        $ip = self::ipdir();
        Link::create(['article' => $articulo, 'user' => $user, 'visitor' => $ip, 'origin' => $origen]);
      }
      $user = 0;
    }
    $articles = Article::orderBy('created_at','desc')->take(10)->get();
    return view('articles.'.$articulo, ['articles' => $articles, 'user' => $user]);
  }
}
