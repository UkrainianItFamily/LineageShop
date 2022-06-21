<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminResetUserPasswordMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private string $email;
    private string $password;

    public function __construct(
        string $email,
        string $password
    ) {
        $this->email = $email;
        $this->password = $password;
    }

    public function build()
    {
        $subject = 'Новый пароль';
        $password = $this->password;

        return $this
            ->subject($subject)
            ->to($this->email)
            ->view('emails.admin-reset-password', compact('password'));
    }
}
