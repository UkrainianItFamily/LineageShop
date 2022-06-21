<?php

declare(strict_types=1);

namespace App\Exceptions\UserWallet;

use Throwable;
use App\Exceptions\BaseException;

final class UserWalletNotFoundException extends BaseException
{
    public function __construct($message = 'User wallet not found', $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
