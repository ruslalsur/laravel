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

//Страница приветствия
Route::get('/', 'HomeController@index')->name('home');

// Новости
Route::group(
    [
        'prefix' => 'news',
        'namespace' => 'News',
        'as' => 'news.'
    ],
    function () {
        Route::get('/categories', 'NewsController@showAllCategories')->name('categories');
        Route::get('/currentCategory/{category}', 'NewsController@showCurrentCategoryNews')->name('currentCategory');
        Route::get('/newsOne{news}', 'NewsController@showNewsOne')->name('newsOne');
        Route::get('/download/{news}', 'NewsController@download')->name('download');
        Route::get('/about', 'AboutController@index')->name('about');
    }
);

// Авторизация старая
//Route::group(
//    [
//        'prefix' => 'auth',
//        'namespace' => 'NewsAuth',
//        'as' => 'auth.'
//    ],
//    function () {
//        Route::match(['GET', 'POST'], '/reg', 'AuthController@reg')->name('reg');
//        Route::match(['GET', 'POST'], '/login', 'AuthController@login')->name('login');
//        Route::get('/logout', 'AuthController@logout')->name('logout');
//    }
//);

// CRUD
Route::resource('news', 'Admin\NewsCrudResourceController', ['except' => ['index', 'show']])->middleware('auth');
Route::match(['get', 'post'], '/admin/profile', 'Admin\ProfileController@update')->name('updateProfile')->middleware('auth');
Route::resource('category', 'Admin\CategoryCrudResourceController')->only(['create', 'store', 'destroy']);

//Авторизация
//Auth::routes();
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');


