<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SocialAuthController extends Controller
{
    // Metodo encargado de la redireccion a Facebook
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Metodo encargado de obtener la información del usuario
    public function handleProviderCallback(Request $request)
    {
        
        // If user cancels the facebook login
        if ($request->error) {
            return redirect('login');
        }
        // Get the user data
        $social_user = Socialite::driver('facebook')->user();
        $token = $social_user->token;
        

        // Validate facebook error when user cancel register and facebook also return an user without email
        if ($social_user->email == null) {
            return redirect('login');
        }
        // Check if user already exist
        if ($user = User::where('email', $social_user->email)->first()) { 
            return $this->authAndRedirect($user);
        } else {  
            // If user does not exist, will be create
            $user = User::create([
                'name' => $social_user->name,
                'email' => $social_user->email,
                'lastname' => "",
                'phone' => 0,
                'code' => uniqid(),
                'city' => 525,
                'facebook_token' => $token,
            ]);
 
            return $this->authAndRedirect($user); 
        }
    }

    // Login with facebook through api
    public function loginfacebookapi(Request $request) {
        $req = $request->all();
        $status = 400;
        $data = [];
        $error = "";
        if(strlen($req["facebook_token"]) > 0 ) {
            $token = $req["facebook_token"];
            $bf_user = Socialite::driver('facebook')->userFromToken($token);
            if (count(User::where('email', $bf_user->email)->get()) > 0) {
                $user = User::where('email', $bf_user->email)->first();
                $user->facebook_token = $token;
                $user->save();
                $status = 200;
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
                $message = "Usuario correcto de facebook";
                return response()->json([
                    'message' => $message,
                    'data'   => $data, 
                ], $status );
            } else {

                $bf_user = Socialite::driver('facebook')->userFromToken($token);
                // Create the user
                $user = User::create([
                    'name'     => $bf_user->name,
                    'email'    => $bf_user->email,
                    'lastname' => "",
                    'phone'    => 0,
                    'code'     => uniqid(),
                    'city'     => 525,
                    'facebook_token' => $token,
                ]);
                $data = [
                    'id'       => $user->id,
                    'name'     => $user->name,
                    'email   ' => $user->email,
                    'lastname' => $user->lastname,
                    'phone'    => $user->phone,
                    'code'     => $user->code,
                    'city'     => $user->city,
                    'godfather' => $user->godfather,
                    'witness' => $user->witness,
                    'facebook_token' => $user->facebook_token
    
                ];
                $status = 201;
                $message = "Usuario registrado con exito";
                return response()->json([ 
                    'message' => $message,
                    'data'    => $data, 
                ], $status);
            }
        } else {
            $status = 400;
            $data = [];
            $message = "No se recibió el token de facebook";
            return response()->json([
                'message'=>$message,
                'data'=>$data
            ], $status);
        }
        
    }
 
    // Login and redirection
    public function authAndRedirect($user)
    {
        Auth::login($user);
 
        return redirect()->to('/articulos');
    }
}
