<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\State;
use App\City;

class ReportController extends Controller{
  public function vista(){
    $very = Auth::check();
    if(!$very){
      return redirect('/');
    }
    $user = Auth::user();
    $states = State::all();
    $cities = City::all();
    return view('testigo', ['user' => $user, 'states' => $states, 'cities' => $cities]);
  }

  public function registro(){
    return ('Guardar en DB y subir foto');
  }
}
