<?php

declare(strict_types=1);

namespace App\Actions\Order;

final class GetAllOrdersRequest
{
    private ?int $id;
    private ?string $userCustomerLogin;
    private ?string $userSellerLogin;

    public function __construct(
        ?int $id,
        ?string $userCustomerLogin,
        ?string $userSellerLogin
    ) {
        $this->id = $id;
        $this->userCustomerLogin = $userCustomerLogin;
        $this->userSellerLogin = $userSellerLogin;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserCustomerLogin(): ?string
    {
        return $this->userCustomerLogin;
    }

    public function getUserSellerLogin(): ?string
    {
        return $this->userSellerLogin;
    }
}
