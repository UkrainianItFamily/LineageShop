<?php

namespace App\Mail;

use App\Models\SupportRequestMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Constant\SupportRequestConstant;

class SupportRequestMessageMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    private SupportRequestMessage $supportRequestMessage;
    private string $mailToAddress;
    private string $mailFromAddress;
    private int $supportId;
    private int $supportSubjectId;

    public function __construct(
        SupportRequestMessage $supportRequestMessage,
        string $mailToAddress,
        string $mailFromAddress,
        int $supportId,
        int $supportSubjectId
    ) {
        $this->supportRequestMessage = $supportRequestMessage;
        $this->mailToAddress = $mailToAddress;
        $this->mailFromAddress = $mailFromAddress;
        $this->supportId = $supportId;
        $this->supportSubjectId = $supportSubjectId;
    }

    public function build()
    {
        $login = $this->supportRequestMessage->user->getLogin();
        $messageText = $this->supportRequestMessage->getText();
        $supportId = $this->supportId;
        $subject = SupportRequestConstant::SUBJECTS[$this->supportSubjectId];

        return $this
            ->subject($subject)
            ->to($this->mailToAddress)
            ->from($this->mailFromAddress)
            ->view('emails.support-request-new-message', compact(
                'login',
                'messageText',
                'supportId'
            ));
    }
}
