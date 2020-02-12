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

//и так тоже можно (оставлено для примера)
Route::get('/', [
    'uses'=>'HomeController@index',
    'as'=>'home'
]);

Route::get('/categories','NewsController@showAllCategories')->name('categories');
Route::get('/currentCategory/{id}', 'NewsController@showCurrentCategoryNews')->name('currentCategory');
Route::get('/newsOne/{id}', 'NewsController@showNewsOne')->name('newsOne');
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/login', 'NewsAuth\LoginController@login')->name('login');
Route::resource('news', 'Admin\NewsCrudController');
