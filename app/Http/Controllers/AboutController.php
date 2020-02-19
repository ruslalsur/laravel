<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index() {
        return view('about', ['authorizedUserInfo' => Users::getAuthorizedUserInfo()]);
    }
}
