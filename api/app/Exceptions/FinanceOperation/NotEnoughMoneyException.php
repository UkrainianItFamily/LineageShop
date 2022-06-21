<?php

declare(strict_types=1);

namespace App\Exceptions\FinanceOperation;

use Throwable;
use App\Exceptions\BaseException;

final class NotEnoughMoneyException extends BaseException
{
    public function __construct($message = 'Not enough money', $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
