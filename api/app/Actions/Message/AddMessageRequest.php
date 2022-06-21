<?php

declare(strict_types=1);

namespace App\Actions\Message;

class AddMessageRequest
{
    private string $message;
    private int $chatId;

    public function __construct(
        string $message,
        int $chatId
    ) {
        $this->message = $message;
        $this->chatId = $chatId;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return int|null
     */
    public function getChatId(): ?int
    {
        return $this->chatId;
    }
}
