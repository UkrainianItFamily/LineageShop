<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\SupportRequest;
use App\Mail\SupportRequestMail;
use Illuminate\Notifications\Notification;

class SupportRequestNotification extends Notification
{
    use Queueable;

    private SupportRequest $supportRequest;

    public function __construct(SupportRequest $supportRequest)
    {
        $this->supportRequest = $supportRequest;
    }

    public function via(): array
    {
        return ['mail'];
    }

    public function toMail(): SupportRequestMail
    {
        return new SupportRequestMail($this->supportRequest);
    }
}
