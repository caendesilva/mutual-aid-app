<?php

namespace App\Http\Controllers;

use App\Models\DiscordEvent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DeploymentController
{
    public static function run()
    {
        if (file_exists(storage_path('framework/cache/booted'))
            || app()->environment() !== 'production') {
                return;
        }

        DiscordEvent::dispatch(config('app.name', 'Mutual Aid App') 
                . ' has been deployed to the ' . config('app.deployment_name', '') 
                . ' server.', true);

        try {
            $tag = static::getReleaseTag();
            if ($tag) {
                Cache::put('version', $tag);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        touch(storage_path('framework/cache/booted'));
    }

    public static function getReleaseTag()
    {
        try {
            $tags = Http::get('https://api.github.com/repos/caendesilva/mutual-aid-app/tags')
                ->json();

            $latest = $tags[0];
            $tag = $latest['name'];
            return $tag ?? false;
        } catch (\Throwable $th) {
            //throw $th;
        }

        return false;
    }
}
