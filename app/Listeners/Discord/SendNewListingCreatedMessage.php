<?php

namespace App\Listeners\Discord;

class SendNewListingCreatedMessage extends DiscordNotificationListener
{
    protected string $message = 'listing.created';
}
