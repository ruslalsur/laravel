<?php

namespace App\Http\Controllers;


class AboutController extends Controller
{
    public function index() {
        session()->put('referer', "news/about");

        return view('/about');
    }
}
