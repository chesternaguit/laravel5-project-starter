<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Service provider for Administration
        $this->app->bind(
            'App\Modules\Administration\Repositories\Interfaces\UserRepositoryInterface',
            'App\Modules\Administration\Repositories\Eloquent\UserRepository'
        );

        //Service provider for Datatales
        $this->app->bind(
            'App\Modules\Defaults\Repositories\DatatableRepositoryInterface',
            'App\Modules\Defaults\Repositories\DatatableRepository'
        );
    }
}
