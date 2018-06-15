<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\User;
use App\Link;
use App\State;
use App\City;
use Auth;

class SiteController extends Controller{

  public function index(){
    return view('index');
  }

  public function perfil(){
    $very = Auth::check();
    if(!$very){
      return redirect('/');
    }
    $user = Auth::user();
    return view('perfil', ['user' => $user]);
  }

  public function config(){
    $very = Auth::check();
    if(!$very){
      return redirect('/');
    }
    $user = Auth::user();
    $states = State::all();
    $cities = City::all();
    return view('config', ['user' => $user, 'states' => $states, 'cities' => $cities]);
  }

  public function img(){
    return view('comp.img');
  }

  public function privacidad(){
    return view('comp.privacidad');
  }
}
