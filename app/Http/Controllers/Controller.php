<?php

namespace App\Http\Controllers;

use App\User;
use Hash;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected Request $request;

    /**
     * Controller constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        date_default_timezone_set('Asia/Krasnoyarsk');

        $this->request = $request;
    }

    /**
     * сервисный метод для уменьшения дублирования кода
     * заполняет модель данными из реквеста
     * и сохраняет в базу данных
     * используется двумя дочерними контролерами
     *
     * @param User $user
     * @return string
     */
    protected function saveUser(User $user)
    {
        $image = $user->image ?? asset('storage/images/user.png');

        if ($this->request->file('image')) {
            $image = Storage::url(Storage::putFile('public/images', $this->request->file('image')));
        }

        $user->fill([
            'name' => $this->request->post('name'),
            'email' => $this->request->post('email'),
            'avatar' => $image,
            'is_admin' => $this->request->post('is_admin') ? 1 : 0,
            'password' => Hash::make($this->request->post('password'))
        ]);
        $user->save();

        return $user->name;
    }
}

