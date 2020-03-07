<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Hash;

class ProfileController extends Controller
{
    public function update(User $user)
    {
        if ($this->request->isMethod('get')) {
            return view('admin.profile', ['user' => $user]);
        }

        $user->fill([
            'name' => $this->request->post('name'),
            'email' => $this->request->post('email'),
            'is_admin' => $this->request->post('is_admin') ? 1 : 0,
            'password' => $this->request->post('password')
                ? Hash::make($this->request->post('password'))
                : $user->password,
        ]);
        $user->save();

        return redirect()->route('admin.updateProfile', $user)->with('success', "Данные пользователя {$user->name} изменены");
    }
}
