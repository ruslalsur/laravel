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
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

Route::get('/categories', 'NewsController@showAllCategories')->name('categories');
Route::get('/currentCategory/{id}', 'NewsController@showCurrentCategoryNews')->name('currentCategory');
Route::get('/newsOne/{id}', 'NewsController@showNewsOne')->name('newsOne');
Route::get('/about', 'AboutController@index')->name('about');
Route::get('/download/{id}', 'NewsController@download')->name('download');

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

Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'as' => 'admin.'
    ],
    function () {
        Route::get('/show/{id}', 'NewsCrudController@showCrudForm')->name('show');
        Route::post('/edit/{id}', 'NewsCrudController@edit')->name('edit');
        Route::get('/reset', 'NewsCrudController@reset')->name('reset');
    }
);

Route::resource('crud', 'CrudController');
