<?php

namespace App\Http\Controllers;

use App\Models\DiscordEvent;
use App\Notifications\DiscordNotification;
use Illuminate\Http\Request;

class DiscordController extends Controller
{
    public function ping(Request $request)
    {
        abort_unless($request->user()->hasRole('admin'), 403);

        return (new DiscordEvent)->notify(new DiscordNotification('beep'));
    }
}
