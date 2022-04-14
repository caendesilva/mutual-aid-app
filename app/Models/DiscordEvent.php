<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class DiscordEvent extends Model
{
    use Notifiable;

    public function routeNotificationForDiscord()
    {
        return config('services.discord.route');
    }

    public static function canSendNotification()
    {
        return config('services.discord.token') != ''
                && config('services.discord.route') != ''
                && app()->environment() !== 'testing';
    }
}
