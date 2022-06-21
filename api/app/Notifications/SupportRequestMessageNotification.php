<?php

namespace App\Notifications;

use App\Mail\SupportRequestMessageMail;
use App\Models\SupportRequestMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SupportRequestMessageNotification extends Notification
{
    use Queueable;

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

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): SupportRequestMessageMail
    {
        return new SupportRequestMessageMail(
            $this->supportRequestMessage,
            $this->mailToAddress,
            $this->mailFromAddress,
            $this->supportId,
            $this->supportSubjectId
        );
    }
}
