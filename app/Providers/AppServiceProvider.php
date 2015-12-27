<?php

namespace App\Providers;

use App\Repositories\UnitRepository;
use App\Unit;
use Contacts\Repository;
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
        $this->app->bind(Repository::class, function($app) {
           return new UnitRepository(new Unit); 
        });
    }
}
