<?php

namespace App\Http\Controllers;

use App\Users;

class HomeController extends Controller
{
    public function index()
    {
        return view('index', ['authorizedUserInfo' =>Users::getAuthorizedUserInfo()]);
    }
}
