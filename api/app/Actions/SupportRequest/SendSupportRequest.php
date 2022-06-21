<?php

declare(strict_types=1);

namespace App\Actions\SupportRequest;

final class SendSupportRequest
{
    private string $text;
    private ?int $subject;
    private ?int $orderId;
    private string $login;
    private string $email;

    public function __construct(
        string $text,
        ?int $subject,
        ?int $orderId,
        string $login,
        string $email
    ) {
        $this->text = $text;
        $this->subject = $subject;
        $this->orderId = $orderId;
        $this->login = $login;
        $this->email = $email;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getSubject(): ?int
    {
        return $this->subject;
    }

    public function getOrderId(): ?int
    {
        return $this->orderId;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
