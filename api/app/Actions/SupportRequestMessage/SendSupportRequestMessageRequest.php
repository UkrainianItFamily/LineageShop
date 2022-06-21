<?php

declare(strict_types=1);

namespace App\Actions\SupportRequestMessage;

final class SendSupportRequestMessageRequest
{
    private string $text;
    private int $supportRequestId;
    private ?int $supportRequestAuthorId;
    private ?int $supportRequestSubjectId;

    public function __construct(
        string $text,
        int $supportRequestId,
        ?int $supportRequestAuthorId = null,
        ?int $supportRequestSubjectId = null
    ) {
        $this->text = $text;
        $this->supportRequestId = $supportRequestId;
        $this->supportRequestAuthorId = $supportRequestAuthorId;
        $this->supportRequestSubjectId = $supportRequestSubjectId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getSupportRequestId(): int
    {
        return $this->supportRequestId;
    }

    public function getSupportRequestAuthorId(): ?int
    {
        return $this->supportRequestAuthorId;
    }

    public function getSupportRequestSubjectId(): ?int
    {
        return $this->supportRequestSubjectId;
    }
}
