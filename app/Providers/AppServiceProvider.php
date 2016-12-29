<?php

namespace App\Providers;

use App\Category;
use App\Contracts\Repository;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImeiController;
use App\Http\Controllers\KindController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\XMCTBController;
use App\Kind;
use App\News;
use App\Order;
use App\Purpose;
use App\Repositories\CategoryRepository;
use App\Repositories\KindRepository;
use App\Repositories\NewsRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PurposeRepository;
use App\Repositories\ShipRepository;
use App\Repositories\UnitRepository;
use App\Repositories\UserRepository;
use App\Ship;
use App\Unit;
use App\User;
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
        view()->composer(['orders.index', 'orders.edit','statistics.unit', 'statistics.advance'], function($view) {
            $units = new UnitRepository(new  Unit);
            $categories = new CategoryRepository(new Category);
            $kinds = new KindRepository(new Kind);
            $users = new UserRepository(new User);
            $purposes = new PurposeRepository(new Purpose); 

            // $units = $units->formatData($units->all(['id', 'symbol']));
            $unitPolices = $units->findAllBy('block', 'CS', ['id', 'symbol']);
            $unitSecurites = $units->findAllBy('block', 'AN', ['id', 'symbol']);
            $categories = $categories->formatData($categories->all(['id', 'symbol']));
            $kinds = $kinds->formatData($kinds->all(['id', 'symbol']));
            $users = $users->formatData($users->all(['id as id', 'fullname as symbol' ]));
            $purposes = $purposes->formatData($purposes->all(['id', 'symbol']));
            $view->with(compact('unitPolices', 'unitSecurites', 'categories', 'kinds', 'purposes', 'users'));
        });
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
        $this->app->when(StatisticController::class)->needs(Repository::class)->give(function($app) {

            return new OrderRepository(new Order);
        });
        $this->app->when(ShipController::class)->needs(Repository::class)->give(function($app) {

            return new ShipRepository(new Ship);
        });
        $this->app->when(NewsController::class)->needs(Repository::class)->give(function($app) {

            return new ShipRepository(new Ship);
        });
        $this->app->when(ImeiController::class)->needs(Repository::class)->give(function($app) {

            return new ShipRepository(new Ship);
        });
        $this->app->when(XMCTBController::class)->needs(Repository::class)->give(function($app) {

            return new ShipRepository(new Ship);
        });

        $this->app->when('App\Http\Controllers\Auth\AuthController')->needs(Repository::class)->give(function($app) {
            return new UserRepository(new User);
        });


    }
}
