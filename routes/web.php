<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('index', ['title'=>'Глубокое погружение']);
//});

Route::get('/', [
    'uses'=>'HomeController@index',
    'as'=>'home'
]);

Route::get('/cat', [
    'uses'=>'NewsController@getAllCategories',
    'as'=>'cat'
]);

Route::get('/currentCat/{id}', [
    'uses'=>'NewsController@getCurrentCategoryNews',
    'as'=>'currentCat'
]);

Route::get('/newsOne/{id}', [
    'uses'=>'NewsController@getNewsOne',
    'as'=>'newsOne'
]);

Route::get('/about', [
    'uses'=>'AboutController@index',
    'as'=>'about'
]);

Route::get('/login', [
    'uses'=>'NewsAuth\LoginController@login',
    'as'=>'login'
]);

Route::get('/addNews', [
    'uses'=>'NewsController@addNews',
    'as'=>'addNews'
]);
