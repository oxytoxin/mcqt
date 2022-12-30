<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        Model::unguard();
        Model::shouldBeStrict();
        Schema::defaultStringLength(191);

        Filament::serving(function () {
            Filament::registerViteTheme('resources/css/filament.css');
        });
    }
}
