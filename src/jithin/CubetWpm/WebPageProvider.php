<?php

namespace jithin\CubetWpm;

use App;
use Illuminate\Support\ServiceProvider;
use jithin\CubetWpm\WebPages;

class WebPageProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!is_dir($directory = app_path('Http/Console/Commands'))) {
            mkdir($directory, 0755, true);
        }

        $this->publishes([
            __DIR__ . '/../../database/migrations/' => database_path('migrations'),
        ], 'migrations');
        $this->publishes([
            __DIR__ . '/Console/command/' => app_path('Console/Commands'),
        ], 'commands');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('WebPage', function () {
            return new WebPages();
        });
    }
}
