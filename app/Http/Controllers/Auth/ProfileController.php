<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;

class ProfileController extends Controller
{
    public function update(User $user)
    {
        if ($this->request->isMethod('get')) {
//            session()->flash('referer', 'auth.updateProfile');

            return view('auth.profile', [
                'user' => $user,
                'title' => 'Личный кабинет пользователя',
                'route' =>'auth.updateProfile',
                'method' => 'POST',
                'showIsAdmin' => false,
            ]);
        }
        $name = $this->userCRUDComponent($user);

        return redirect()->route('auth.updateProfile', $user)->with('success', "Данные пользователя {$name} изменены");
    }
}
