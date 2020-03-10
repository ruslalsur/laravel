<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Support\Facades\Auth;
use Storage;


class ProfileController extends Controller
{
    public function update()
    {
        $user = Auth::user();

        if ($this->request->isMethod('get')) {
            return view('auth.profile', ['user' => $user]);
        }

        $image = asset('/img/user.png');
        if ($this->request->file('image')) {
            $image = Storage::putFile('public', $this->request->file('image'));
            $image = Storage::url($image);
        }


        $user->fill([
            'name' => $this->request->post('name'),
            'email' => $this->request->post('email'),
            'avatar' => $image,
//            'is_admin' => $this->request->post('is_admin') ? 1 : 0,
            'password' => $this->request->post('password')
                ? Hash::make($this->request->post('password'))
                : $user->password,
        ]);
        $user->save();

        return redirect()->route('auth.updateProfile', $user)->with('success', "Данные пользователя {$user->name} изменены");
    }
}
