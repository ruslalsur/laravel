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

// Новости
Route::get('/', 'News\HomeController@index')->name('news.home');

Route::group(
    [
        'prefix' => 'news',
        'namespace' => 'News',
        'as' => 'news.'
    ],
    function () {
        Route::get('/categories', 'NewsController@showAllCategories')->name('categories');
        Route::get('/currentCategory/{id}', 'NewsController@showCurrentCategoryNews')->name('currentCategory');
        Route::get('/newsOne/{id}', 'NewsController@showNewsOne')->name('newsOne');
        Route::get('/about', 'AboutController@index')->name('about');
        Route::get('/download/{id}', 'NewsController@download')->name('download');
    }
);

// авторизация
Route::group(
    [
        'prefix' => 'auth',
        'namespace' => 'NewsAuth',
        'as' => 'auth.'
    ],
    function () {
        Route::match(['GET', 'POST'], '/reg', 'AuthController@reg')->name('reg');
        Route::match(['GET', 'POST'], '/login', 'AuthController@login')->name('login');
        Route::get('/logout', 'AuthController@logout')->name('logout');
    }
);

// crud
Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'as' => 'admin.'
    ],
    function () {
        Route::match(['GET', 'POST'],'/edit/{id}', 'NewsCrudController@update')->name('edit');
        Route::match(['GET', 'POST'],'/add', 'NewsCrudController@create')->name('add');
        Route::match(['GET', 'POST'],'/delete/{id}', 'NewsCrudController@destroy')->name('delete');
        Route::match(['GET', 'POST'],'/categoryCreator', 'NewsCrudController@categoryCreator')->name('categoryCreator');
        Route::get('/reset', 'NewsCrudController@reset')->name('reset');
    }
);
