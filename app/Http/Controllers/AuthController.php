<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function welcome() {
        if(auth()->user()) {
            return redirect()->route('home');
        }

        return view('welcome.index');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('welcome');
    }

    public function googleRedirect() {
        return Socialite::driver('google')->redirect();
    }
    public function googleCallback(Request $request) {
        if ($request->has('error')) {
            return redirect()->route('home');
        }

        $callback = Socialite::driver('google')->user();
        $validate = User::where('email', $callback->getEmail())->where('google_id', null)->first();
        $userCheck = User::where('google_id', $callback->getId())->first();
        
        if($validate) {
            return redirect()->route('welcome')->with('error', 'Email mu sudah terdaftar tapi tidak pakai Google');
        }

        if ($userCheck) {
            $userCheck->name = $callback->getName();
            $userCheck->email = $callback->getEmail();
            $userCheck->avatar = $callback->getAvatar();
            $userCheck->save();
            Auth::loginUsingId($userCheck->id);
            return redirect()->route('home');
        } else {
            $data = [
                'name' => $callback->getName(),
                'email' => $callback->getEmail(),
                'avatar' => $callback->getAvatar(),
                'role' => 'pending',
                'google_id' => $callback->getId(),
                'password' => Hash::make('GoogleID_'.$callback->getId.rand(000, 999999)),
                'vendor' => "Google"
            ];
            $user = User::create($data);
            Auth::loginUsingId($user->id);
            return redirect()->route('home');
        }
    }
}