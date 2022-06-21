<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Mail\AccountVerificationMail;
use Illuminate\Notifications\Notification;

class VerifyNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = $this->verificationUrl($notifiable);

        return (new AccountVerificationMail())->build($url);
    }

    protected function verificationUrl($notifiable)
    {
        return  env('APP_URL').'/email-verification?'.http_build_query(
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );
    }

    public function toArray($notifiable): array
    {
        return [

        ];
    }
}
