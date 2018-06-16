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
    $article = Article::find($articulo);
    return view('articles.showarticle')->with('article', $article);
  }


  public function registro($id){
    $article = Article::find($id);
    
    return view('articles.showarticle')->with('article', $article);
  }

  public function getArticles(Request $request) {
    $req = $request->all();
    $articles = Article::all();
    $message = "Lista de articulos";
    $data = [];
    foreach($articles as $article) {
      $a = ["id"=>$article->id, "title"=>$article->title, "content"=>$article->content, "date"=>$article->date];
      array_push($data, $a);
    }
    return response()->json([
      'message'=>$message,
      'data'=>$articles
    ],200);
  }

  public function getArticle(Request $request, $id) {
    if ($id == "") {
      return response()->json([
        'message'=>'No hay id para buscar articulo',
        'data'=>[]
      ],400);
    }
    $article = Article::where('id', $id)->first();
    if($article){

      $message = "Envio de articulo";
      $url = "https://www.accioncolombia.com.co/articulo/" . $article->id;
      $data = [
        'id'=>$article->id,
        'title'=>$article->title,
        'content'=>$article->content,
        'video'=>$article->video,
        'date'=>$article->date,
        'url'=>$url
      ];
      return response()->json([
        'message'=>$message,
        'data'=>$data
      ], 200);
      
    } else {
      return response()->json([
        'message'=>'Articulo no encontrado',
        'data'=>[]
      ],404);
    }
  }
}
