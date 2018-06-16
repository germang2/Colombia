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
            ], $status);

        } else if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $status = 200;
            $message = "Usuario y contraseña correctos";
            $user = User::where('email', $email)->first();
            $data = [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'lastname' => $user->lastname,
                'phone' => $user->phone,
                'city' => $user->city,
                'godfather' => $user->godfather,
                'witness' => $user->witness,
                'facebook_token' => $user->facebook_token
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
            ], $status);
        }
    }

    // This controller is for register users through api
    public function registerapi(Request $request) {
        $req = $request->all();
        try {
            $user = User::create([
                'name' => $req["name"],
                'email' => $req["email"],
                'password' => bcrypt($req["password"]),
                'lastname' => $req["lastname"],
                'phone' => $req["phone"],
                'code' => uniqid(),
                'city' => $req["city"],
                'godfather' => $req["godfather"],
                'witness' => $req["witness"]
            ]);
            $status = 200;
            $message = "Usuario creado con éxito";
            $data = [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
                'lastname' => $user->lastname,
                'phone' => $user->phone,
                'city' => $user->city,
                'godfather' => $user->godfather,
                'witness' => $user->witness,
                'facebook_token' => $user->facebook_token
            ];
            return response()->json([
                $message,
                $data
            ], $status);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
