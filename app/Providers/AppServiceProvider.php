<?php

namespace App\Providers;

use App\Helpers\WMenu;
use Theme;
use Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('irayol-menu', function () {
            return new WMenu();
        });

        if ($this->app->runningInConsole()) {
            $this->app->register('CrestApps\CodeGenerator\CodeGeneratorServiceProvider');
        }

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
