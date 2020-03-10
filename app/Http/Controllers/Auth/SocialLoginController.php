<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repo\UserRepo;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    //yandex
    public function requestYa()
    {
        return Socialite::with('yandex')->redirect();
    }

    public function responseYa(UserRepo $userRepo, $socName = 'yandex')
    {
        if (Auth::check()) {
            return redirect()->route('home')->with('success', 'Пользователь '.Auth::getName().' уже авторизован');
        }

        $user = Socialite::driver('yandex')->user();
        $userToLogin = $userRepo->getUserBySocAccount( $user, $socName);
        Auth::login($userToLogin);

        return redirect()->route('home')->with('success', "Пользователь {$user->getName()} авторизовался через {$socName}");
    }


    //github
    public function requestGit()
    {
        return Socialite::with('github')->redirect();
    }

    public function responseGit(UserRepo $userRepo, $socName = 'github')
    {
        if (Auth::check()) {
            return redirect()->route('home')->with('success', 'Пользователь '.Auth::getName().' уже авторизован');
        }

        $user = Socialite::driver('github')->user();
        $userToLogin = $userRepo->getUserBySocAccount( $user, $socName);
        Auth::login($userToLogin);

        return redirect()->route('home')->with('success', "Пользователь {$user->getName()} авторизовался через {$socName}");
    }
}
