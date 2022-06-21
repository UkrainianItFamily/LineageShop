<?php

declare(strict_types=1);

namespace App\Exceptions\Order;

use Throwable;
use App\Exceptions\BaseException;

final class OrderNotFoundException extends BaseException
{
    public function __construct($message = 'Order not found', $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
