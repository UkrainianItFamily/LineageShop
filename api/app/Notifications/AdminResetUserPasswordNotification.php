<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Mail\AdminResetUserPasswordMail;
use Illuminate\Notifications\Notification;

class AdminResetUserPasswordNotification extends Notification
{
    use Queueable;

    private string $email;
    private string $password;

    public function __construct(
        string $email,
        string $password
    ) {
        $this->email = $email;
        $this->password = $password;
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): AdminResetUserPasswordMail
    {
        return new AdminResetUserPasswordMail($this->email, $this->password);
    }
}
