<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Users;

class AboutController extends Controller
{
    public function index() {
        return view('news/about', ['authorizedUserInfo' => Users::getAuthorizedUserInfo()]);
    }
}
