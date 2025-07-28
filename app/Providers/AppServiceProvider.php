<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $modulesPath = app_path('Modules');
        $modules = array_map('basename', File::directories($modulesPath));

        foreach ($modules as $module) {
            $viewPath = "$modulesPath/$module/views";
            if (File::exists($viewPath)) {
                $this->loadViewsFrom($viewPath, $module);
            }
        }
    }
}
