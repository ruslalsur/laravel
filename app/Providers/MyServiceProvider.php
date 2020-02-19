<?php


namespace App\Providers;

use App\Users;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class MyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->forwardDataToLayout();
    }

    /**
     * Почему не пробрасывается непонятно!
     *
     *@return void
     */
//    private function forwardDataToLayout()
//    {
//        View::composer('layouts.main', function ($view) {
//           $view->with(['authorizedUserInfo' => Users::getAuthorizedUserInfo()]);
//        });
//    }
}
