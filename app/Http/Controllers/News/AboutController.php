<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Users;

class AboutController extends Controller
{
    public function index() {
        session()->flash('referer', "news/about");
        return view('news/about');
    }
}
