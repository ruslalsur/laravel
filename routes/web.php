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

// CRUD
Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'as' => 'admin.',
        'middleware' => ['auth', 'isAdmin']
    ],
    function () {
        Route::resource('news', 'NewsCrudResourceController', ['except' => ['index', 'show']]);
        Route::match(['GET', 'POST'], '/profile{user}', 'ProfileController@update')->name('updateProfile')->middleware(['auth', 'profVal', 'isAdmin']);
        Route::resource('category', 'CategoryCrudResourceController')->only(['create', 'store', 'destroy']);
    }
);

// Авторизация
Route::group(
    [
        'prefix' => 'auth',
        'namespace' => 'Auth',
        'as' => 'auth.'
    ],
    function () {
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LoginController@logout')->name('logout');

        Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
        Route::post('register', 'RegisterController@register');
    }
);

