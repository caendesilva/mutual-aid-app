<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class VersionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'git.branch',
            function () {
                return \App\Core\Services\VersionService::gitBranch();
            }
        );

        $this->app->bind(
            'git.version',
            function () {
                return \App\Core\Services\VersionService::gitVersion();
            }
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
