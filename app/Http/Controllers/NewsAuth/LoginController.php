<?php

namespace App\Http\Controllers\NewsAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login()
    {
        return view('login', ['title'=>'Вход']);
    }
}
