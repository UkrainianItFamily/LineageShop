<?php

declare(strict_types=1);

namespace App\Actions\Order;

final class AddOrderRequest
{
    private int $productId;
    private int $userSellerId;
    private int $walletTypeId;
    private ?string $nickname;
    private ?int $quantity;

    public function __construct(
        int $productId,
        int $userSellerId,
        int $walletTypeId,
        ?string $nickname,
        ?int $quantity
    ) {
        $this->productId = $productId;
        $this->userSellerId = $userSellerId;
        $this->walletTypeId = $walletTypeId;
        $this->nickname = $nickname;
        $this->quantity = $quantity;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getUserSellerId(): int
    {
        return $this->userSellerId;
    }

    public function getWalletTypeId(): int
    {
        return $this->walletTypeId;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }
}
