<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Social;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        }catch (Throwable $th){
            return redirect(route('login'));
        }
            $user = User::where('email', $socialUser->getEmail())->first();
            $name = $socialUser->getNickname() ?? $socialUser->getName();
            if (!$user) {
                $user = User::create([
                    'name' => $name,
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make(Str::random(7)),
                    'avatar' => $socialUser->getAvatar(),
                ])->assignRole('user');

                $user->socials()->create([
                    'provider_id' => $socialUser->getId(),
                    'provder' => $provider,
                    'provider_token' => $socialUser->token,
                    'provider_refresh_token' => $socialUser->refreshToken
                ]);
            }

            $socials = Social::where('provider', $provider)->where('user_id', $user->id)->first();
            if (!$socials) {
                $user->socials()->create([
                    'provider_id' => $socialUser->getId(),
                    'provder' => $provider,
                    'provider_token' => $socialUser->token,
                    'provider_refresh_token' => $socialUser->refreshToken
                ]);
            }

            auth()->login($user);

            return redirect('/dashboard');
       
    }
}
