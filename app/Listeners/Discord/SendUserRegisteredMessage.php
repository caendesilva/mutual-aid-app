<?php

namespace App\Listeners\Discord;

class SendUserRegisteredMessage extends DiscordNotificationListener
{
    protected string $message = 'user.registered';
}
