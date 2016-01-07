<?php

namespace App\Providers;

use App\Category;
use App\Contracts\Repository;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\KindController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UnitController;
use App\Kind;
use App\Order;
use App\Repositories\CategoryRepository;
use App\Repositories\KindRepository;
use App\Repositories\OrderRepository;
use App\Repositories\UnitRepository;
use App\Unit;
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
        
        $this->app->when(UnitController::class)->needs(Repository::class)->give(function($app) {

            return new UnitRepository(new Unit);
        });
        $this->app->when(CategoryController::class)->needs(Repository::class)->give(function($app) {

            return new CategoryRepository(new Category);
        });
        $this->app->when(KindController::class)->needs(Repository::class)->give(function($app) {

            return new KindRepository(new Kind);
        });
        $this->app->when(OrderController::class)->needs(Repository::class)->give(function($app) {

            return new OrderRepository(new Order);
        });
    }
}
