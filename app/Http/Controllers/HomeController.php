<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Shared;
use App\User;
use App\Link;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
      $user = Auth::user();
      $articles = Article::orderBy('created_at','desc')->take(10)->get();
      $referidos = User::where('godfather', $user->code)->count();
      $publicados = Article::all()->count();
      $compartidos = Shared::where('user', $user->id)->count();
      $visitados = Link::where('user', $user->id)->count();
      return view('home', ['articles' => $articles, 'referidos' => $referidos, 'publicados' => $publicados, 'user' => $user, 'compartidos' => $compartidos, 'visitados' => $visitados]);
    }
}
