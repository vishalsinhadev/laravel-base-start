<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $modulesPath = app_path('Modules');

        $modules = array_map('basename', File::directories($modulesPath));

        foreach ($modules as $module) {
            $routePath = "$modulesPath/$module/routes/web.php";

            if (File::exists($routePath)) {
                Route::middleware('web')
                    ->namespace("App\\Modules\\$module\\Controllers")
                    ->group($routePath);
            }
        }
    }

    public function register(): void {}
}
