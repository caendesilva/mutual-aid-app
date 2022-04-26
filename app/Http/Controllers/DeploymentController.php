<?php

namespace App\Http\Controllers;

use App\Models\DiscordEvent;

class DeploymentController
{
    public static function notify()
    {
        if (file_exists(storage_path('framework/cache/booted'))
            || app()->environment() !== 'production') {
                return;
        }

        DiscordEvent::dispatch(config('app.name', 'Mutual Aid App') 
                . ' has been deployed to the ' . config('app.deployment_name', '') 
                . ' server.', true);

        touch(storage_path('framework/cache/booted'));
    }
}
