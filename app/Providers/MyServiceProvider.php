<?php


namespace App\Providers;

use App\Users;
use Illuminate\Support\ServiceProvider;

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
        $this->forwardDataToLayout();
    }

    /**
     * Пробрасывание данных в главный шаблон,
     * чтобы они были доступны во всех шаблонах которые его наследуют (не работает как задумывалось везде
     * пришлось пробрасывать)
     *
     *@return void
     */
    private function forwardDataToLayout()
    {
        \View::composer('layouts.main', function ($view) {
           $view->with('authorizedUserInfo', Users::getAuthorizedUserInfo());
        });
    }
}
