<?php

namespace App\Providers;

use App\Repositories\LikesRepository;
use App\Repositories\MoviesRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaces\LikesRepositoryInterface;
use App\Repositories\Interfaces\MoviesRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            MoviesRepositoryInterface::class, 
            MoviesRepository::class
        );
        $this->app->bind(
            LikesRepositoryInterface::class, 
            LikesRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
