<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Systemsettings;

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
        $this->settings= Systemsettings::first();

        view()->composer('layouts.client', function($view) {
            $view->with(['settings' => $this->settings]);
        });

        $this->settings= Systemsettings::first();

        view()->composer('layouts.admin', function($view) {
            $view->with(['settings' => $this->settings]);
        });

        $this->settings= Systemsettings::first();

        view()->composer('components.sidebar', function($view) {
            $view->with(['settings' => $this->settings]);
        });
        Schema::defaultStringLength(125);
        //
    }
}
