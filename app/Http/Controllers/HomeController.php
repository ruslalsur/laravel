<?php

namespace App\Http\Controllers;

use App\News;
use App\Users;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index', ['authorizedUserInfo' =>Users::getAuthorizedUserInfo()]);
    }
}
