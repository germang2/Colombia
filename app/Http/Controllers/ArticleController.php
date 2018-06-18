<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use App\Link;
use Auth;
use App\Shared;
use Socialite;

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
    $article->seen += 1;
    $article->save();
    return view('articles.showarticle')->with('article', $article);
  }


  public function registro($id){
    $article = Article::find($id);
    
    return view('articles.showarticle')->with('article', $article);
  }

  public function createMetric($user_id, $article_id, $social_red) {
    Shared::create([
      "article"=>$article_id,
      "user"=>$user_id,
      "type"=>$social_red,
      "shared"=>1,
      "left"=>199
      ]);
  }

  public function getUserByToken($token, $type) {
    $user = "";
    if ($type == "facebook_token") {
      // Search the facebook user
      $bf_user = Socialite::driver('facebook')->userFromToken($token);
      // Then search the user in DB, using email. This is necesary becasuse the facebook token can change
      $user = User::where('email', $bf_user->email)->first();
      // if Facebook token is diferent of user token in DB, will be update in DB
      if ($bf_user->token != $user->facebook_token) {
        $user->facebook_token = $bf_user->token;
        $user->save();
      }
      
    } else {
      $user = User::where('token', $token)->first();
    }

    return $user;
  }

  public function checkAndCreateMetric($articles, $user) {
    $social_red = ["whatsapp", "facebook", "twitter"];
    // Verify if the user aleady have the metric for each article with each social red
    foreach ($articles as $article) {
      foreach ($social_red as $sr) {
        // If the metric doesn't exist, will be created with the function createMetric()
        $user_id = $user->id;
        $article_id = $article->id;
        if (!Shared::where('article', $article->id)->where('type', $sr)->where('user', $user->id)->first()) {
          $this->createMetric($user_id, $article_id, $sr);
        }
      }
    }
  }

  public function getMetricsArticle($user, $article) {
    
    $metrics = Shared::where('article', $article->id)->where('user', $user->id)->get();
    $social_red_array = [];
    foreach ($metrics as $metric) {
      $social_red_data = ["shared" => $metric->shared, "left" => $metric->left];
      $social_red_array[$metric->type] = $social_red_data;
    }
    return $social_red_array;
    
  }

  public function getArticles(Request $request) {
    $articles = Article::all();

    $user = "";
    // Check if there is a facebook token or user token for add in response the metrics of that user
    if ($request->facebook_token or $request->token) {
      $token = "";
      $type_token;
      if ($request->facebook_token) {
        $token = $request->facebook_token;
        $type_token = "facebook_token";
        $user = $this->getUserByToken($request->facebook_token, "facebook_token");
      } else {
        $token = $request->token;
        $type_token = "token";
        $user = $this->getUserByToken($token, "token");
      }
      if (!$user or $user == "") {
        return response()->json([
          'message'=>'Usuario no encontrado',
          'data'=>["token"=>$token, "type_token"=>$type_token]
        ], 404);
      }
      // get all articles for check if the metric already exist for that user
      $articles = Article::all();
      $this->checkAndCreateMetric($articles, $user);
    }

    $message = "Lista de articulos";
    $data = [];
    foreach($articles as $article) {
      $a = [
      "id"=>$article->id, 
      "title"=>$article->title, 
      "content"=>$article->content, 
      "date"=>$article->date,
      "video"=>$article->video,
      "seen"=>$article->seen,
      "url"=>"https://www.accioncolombia.com.co/articulo/" . $article->id
    ];

    if ($user != "") {
      $data_metrics = $this->getMetricsArticle($user, $article);
      $a["social_red_data"] = $data_metrics;
    }

    array_push($data, $a);
    }
    return response()->json([
      'message'=>$message,
      'data'=>$data
    ],200);
    
  }

  public function getArticle(Request $request, $id) {
    if ($id == "") {
      return response()->json([
        'message'=>'No hay id para buscar articulo',
        'data'=>[]
      ],400);
    }
    
    $user = "";
    // Check if there is a facebook token or user token for add in response the metrics of that user
    if ($request->facebook_token or $request->token) {
      if ($request->facebook_token) {
        $user = $this->getUserByToken($request->facebook_token, "facebook_token");
      } else {
        $user = $this->getUserByToken($request->token, "token");
      }
      // get all articles for check if the metric already exist for that user
      $articles = Article::all();
      $this->checkAndCreateMetric($articles, $user);
    }

    // get the requested article
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
        'seen'=>$article->seen,
        'url'=>$url
      ];

      // if there exist an user, now searchs the metrics for that article and user
      if ($user != "") {
        $data_metrics = $this->getMetricsArticle($user, $article);
        $data["social_red_data"] = $data_metrics;
      }

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
