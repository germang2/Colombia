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
                'password' => bcrypt($social_user->name),
                'lastname' => "",
                'phone' => 0,
                'code' => uniqid(),
                'city' => 525,
            ]);
 
            return $this->authAndRedirect($user); 
        }
    }
 
    // Login and redirection
    public function authAndRedirect($user)
    {
        Auth::login($user);
 
        return redirect()->to('/articulos');
    }
}
