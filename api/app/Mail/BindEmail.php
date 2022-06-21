<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BindEmail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    private string $email;
    private string $verifyRoute;

    public function __construct(
        string $verifyRoute,
        string $email
    ) {
        $this->email = $email;
        $this->verifyRoute = $verifyRoute;
    }

    public function build()
    {
        $this->to($this->email);
        $verifyRoute = $this->verifyRoute;

        return $this->subject('Заявка на изменение почты')
            ->view('emails.change-email', compact('verifyRoute'));
    }
}
