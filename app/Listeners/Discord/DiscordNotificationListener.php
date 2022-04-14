<?php

namespace App\Listeners\Discord;

use App\Models\DiscordEvent;
use App\Notifications\DiscordNotification;

abstract class DiscordNotificationListener
{
    /**
     * @var string The Discord message to send.
     */
    protected string $message;

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
     * @return void
     */
    public function handle()
    {
        return (new DiscordEvent())->notify(new DiscordNotification($this->message));
    }
}
