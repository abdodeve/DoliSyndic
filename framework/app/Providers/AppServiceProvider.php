<?php

namespace App\Providers;
use App\Models\ProprietaireModel;
use App\Observers\ProprietaireObserver;

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
        ProprietaireModel::observe(ProprietaireObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
