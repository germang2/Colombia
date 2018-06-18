<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    // This controller is for login users through api
    public function loginapi(Request $request) {
        $req = $request->all();
        $email = $req["email"];
        $password = $req["password"];
        if ($email == "" or $password == "") {
            $status = 400;
            $message = "Faltan datos";
            return response()->json([
                'message' => $message,
                'data' => []
            ], $status);

        } else if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $status = 200;
            $message = "Usuario y contraseña correctos";
            $user = User::where('email', $email)->first();
            $data = [
                'id'    =>$user->id,
                'name'  =>$user->name,
                'email' =>$user->email,
                'lastname' =>$user->lastname,
                'phone' =>$user->phone,
                'city' =>$user->city,
                'godfather' =>$user->godfather,
                'witness' =>$user->witness,
                'facebook_token' =>$user->facebook_token,
                'token' =>$user->token
            ];
            return response()->json([
                'message' => $message,
                'data' => $data
            ], $status );
        } else {
            $status = 401;
            $message = "El usuario y la contraseña no coinciden";
            return response()->json([
                'message' => $message,
                'data' => []
            ], $status);
        }
    }

    // This controller is for register users through api
    public function registerapi(Request $request) {
        $req = $request->all();
        

        try {
            if (count(User::where('email', $req["email"])->get()) > 0) {
                $status = 401;
                $message = "Este correo ya está registrado";
                $data = [];
                return response()->json([
                    'message'=>$message,
                    'data'=>$data
                ],$status);
            }
            $user = User::create([
                'name' => $req["name"],
                'email' => $req["email"],
                'password' => bcrypt($req["password"]),
                'lastname' => $req["lastname"],
                'phone' => $req["phone"],
                'code' => uniqid(),
                'city' => $req["city"],
                'godfather' => $req["godfather"],
                'witness' => $req["witness"],
                'token' => bcrypt($req["name"].$req["email"].date_create("Y-m-d H:i:s").env('APP_KEY'))
            ]);
            $status = 200;
            $message = "Usuario creado con éxito";
            $data = [
                'id'    =>$user->id,
                'name'  =>$user->name,
                'email' =>$user->email,
                'lastname' =>$user->lastname,
                'phone' =>$user->phone,
                'city' =>$user->city,
                'godfather' =>$user->godfather,
                'witness' =>$user->witness,
                'facebook_token' =>$user->facebook_token,
                'token' =>$user->token
            ];
            return response()->json([
                'message'=>$message,
                'data'=>$data
            ], $status);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function getusers(Request $request, $cadena) {
        $req = $request->all();
        if (strlen($cadena) > 0) {
            $query = User::where('name', 'like', '%' . $cadena . '%')->orwhere('lastname', 'like', '%' . $cadena . '%')->get();
            $status = 200;
            $message = "Lista de usuarios";
            $data = [
                'users' =>$query
            ];
            return response()->json([
                'message' =>$message,
                'data'=>$data
            ], $status);
        }
    }
}
