<?php

namespace App\Notifications;

use App\Mail\NewMessageEmail;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    private Message $message;

    public function __construct(Message $message)
    {
       $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return new NewMessageEmail($this->message);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
