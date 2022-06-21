<?php

declare(strict_types=1);

namespace App\Exceptions\FinanceOperation;

use Throwable;
use App\Exceptions\BaseException;

final class FinanceOperationCannotBeCanceledException extends BaseException
{
    public function __construct($message = 'Finance operation cannot by canceled', $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
