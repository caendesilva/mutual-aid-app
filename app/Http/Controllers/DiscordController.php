<?php

namespace App\Http\Controllers;

use App\Models\DiscordEvent;
use App\Notifications\DiscordNotification;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DiscordController extends Controller
{
    public function ping(Request $request)
    {
        abort_unless($request->user()->hasRole('admin'), 403);

        return (new DiscordEvent)->notify(new DiscordNotification('beep'));
    }

    public static function httpExceptionNotifier(HttpException $e)
    {
        if ($e->getStatusCode() < 500) {
            return;
        }
        return (new DiscordEvent)->notify(new DiscordNotification('error.HttpException' . $e->getStatusCode()));
    }
}
