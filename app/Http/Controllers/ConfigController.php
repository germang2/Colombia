<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PersonRequest;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\PassRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class ConfigController extends Controller{
  public function personal(PersonRequest $request){
    $user = Auth::user();
    $user->name = $request->name;
    $user->lastname = $request->lastname;
    $user->save();
    return redirect('/perfil');
  }

  public function contacto(ContactRequest $request){
    $user = Auth::user();
    $user->phone = $request->phone;
    $user->save();
    return redirect('/perfil');
  }

  public function city(Passrequest $request){
    $user = Auth::user();
    $user->city = $request->city;
    $user->save();
    return redirect('/perfil');
  }

  public function testigo(Request $request){
    $user = Auth::user();
    $user->witness = $request->witness;
    $user->save();
    return redirect('/perfil');
  }
}
