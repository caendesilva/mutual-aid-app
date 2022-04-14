<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Discord\DiscordChannel;
use NotificationChannels\Discord\DiscordMessage;

class DiscordNotification extends Notification
{
    use Queueable;

    /**
     * The Discord message to send.
     */
    protected string $message;

    /**
     * Create a new notification instance.
     * 
     * @param string $message The Discord message to send.
     *                        Should be a language key defined in the lang file.
     *                        @see lang/en/discord-messages.php
     * @param bool $withoutLangKey If true, the message will be sent without the lang key.
     *                             While discouraged, it allows for on-demand messages.
     * @return void
     */
    public function __construct(string $message, bool $withoutLangKey = false)
    {
        $this->message = $withoutLangKey ? $message : __('discord-messages.' . $message);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [DiscordChannel::class];
    }

    public function toDiscord($notifiable)
    {
        return DiscordMessage::create($this->message);
    }
}
