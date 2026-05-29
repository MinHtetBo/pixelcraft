<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider){
         return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){

         $socialData = Socialite::driver($provider)->user();

         $data = [
            'name' => $socialData->name == null ? $socialData->nickname : $socialData->name,
            'email' =>$socialData->email,
            'profile' =>$socialData->avatar,
            'role' => 'user',
            'provider' =>$provider,
             'provider_id' =>$socialData->id,
              'provider_token' =>$socialData->token
         ];

     $user = User::updateOrCreate([
        'provider_id' =>$socialData->id
     ],$data);

     Auth::login($user);

     return to_route('user#home');


    }
}
