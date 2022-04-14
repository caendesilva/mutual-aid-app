<?php

namespace App\Http\Controllers;

use App\Models\DiscordEvent;
use App\Notifications\DiscordNotification;
use Illuminate\Http\Request;

class DiscordController extends Controller
{
    public function ping()
    {
        return (new DiscordEvent)->notify(new DiscordNotification('beep'));
    }
}
