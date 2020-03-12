<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Users;

class HomeController extends Controller
{
    /**
     * Отображение страницы приветствия
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        session()->flash('referer', "/");
        return view('news/index');
    }
}
