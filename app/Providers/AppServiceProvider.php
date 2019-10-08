<?php

namespace App\Providers;

use App\Entities\League\League;
use App\Entities\League\LeaguePlayer;
use App\Repositories\League\LeaguePlayerRepository;
use App\Repositories\League\LeagueRepository;
use App\Services\League\LeagueService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LeagueService::class, function () {
            return new LeagueService(
                new LeagueRepository(new League()),
                new LeaguePlayerRepository(new LeaguePlayer())
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
