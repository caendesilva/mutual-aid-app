<?php

namespace App\Listeners\Discord;

use App\Models\DiscordEvent;
use App\Notifications\DiscordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserRegisteredMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        return (new DiscordEvent())->notify(new DiscordNotification('user.registered'));
    }
}
