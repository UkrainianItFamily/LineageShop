<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\SupportRequest;
use Illuminate\Queue\SerializesModels;
use App\Constant\SupportRequestConstant;

class SupportRequestMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private SupportRequest $supportRequest;

    public function __construct(SupportRequest $supportRequest)
    {
        $this->supportRequest = $supportRequest;
    }

    public function build()
    {
        $login = $this->supportRequest->getLogin();
        $text = $this->supportRequest->getText();
        $orderId = $this->supportRequest->order ? $this->supportRequest->order->id : null;
        $subject = SupportRequestConstant::SUBJECTS[$this->supportRequest->getSubject()];

        return $this
            ->subject($subject)
            ->to(SupportRequestConstant::SUPPORT_EMAIL)
            ->from($this->supportRequest->author->getEmail())
            ->view('emails.support-request', compact('login','text', 'orderId'));
    }
}
