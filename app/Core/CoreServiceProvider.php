<?php

namespace App\Core;

use App\Http\Controllers\DeploymentController;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

/**
 * The Core Service Provider for the Mutual Aid App
 */
class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Register the @markdownSection directive
        Blade::directive('markdownSection', function ($arguments) {
            return "<?php echo(\App\Core\MarkdownSection::parse({$arguments})); ?>";
        });

        if (! file_exists(storage_path('framework/booted'))) {
            DeploymentController::notify();
        }
    }
}
