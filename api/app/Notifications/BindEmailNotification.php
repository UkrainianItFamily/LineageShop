<?php

namespace App\Notifications;

use App\Mail\BindEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class BindEmailNotification extends Notification
{
    use Queueable;

    private string $token;
    private string $email;

    public function __construct(
        string $token,
        string $email
    ) {
        $this->token = $token;
        $this->email = $email;
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): BindEmail
    {
        return new BindEmail($this->verifyRoute(), $this->email);
    }

    protected function verifyRoute(): string
    {
        return  env('APP_URL').'/account/email?'.http_build_query(
                [
                    'token' => $this->token,
                ]
            );
    }
}
