<?php

namespace App\Models;

use App\Notifications\DiscordNotification;
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

    public static function dispatch(string $event, bool $onDemand = false)
    {
        return (new static)->notify(new DiscordNotification($event, $onDemand));
    }
}
