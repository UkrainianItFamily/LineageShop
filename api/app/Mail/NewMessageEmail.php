<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewMessageEmail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $userEmail = $this->message->chat->getEmailToSendNotificationAboutNewMessage();

        $this->to($userEmail);

        return $this->subject('У Вас новое сообщение!')
            ->view('emails.new-message');
    }
}
