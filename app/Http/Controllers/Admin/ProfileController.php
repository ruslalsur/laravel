<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Auth;
use App\Http\Controllers\Controller;
use Hash;

class ProfileController extends Controller
{
    public function update(User $user)
    {
        $errors = [];

        if ($this->request->isMethod('get')) {
            return view('admin.profile', ['user' => $user]);
        }

        $this->validate($this->request, User::rules(), [], User::attributeNames());

        if (Hash::check($this->request->post('password'), $user->password) |
            $this->request->post('password') === $user->password) {
            $user->fill([
                'name' => $this->request->post('name'),
                'password' => Hash::make($this->request->post('newPassword')),
                'email' => $this->request->post('email'),
                'is_admin' => $this->request->post('is_admin') ? 1 : 0
            ]);
            $user->save();

            $this->request->session()->flash('success', "Данные пользователя {$user->name} изменены");
        } else {
            $errors['password'][] = 'Этот пароль давно устарел';
        }

        return redirect()->route('admin.updateProfile', $user)->withErrors($errors);
    }
}
