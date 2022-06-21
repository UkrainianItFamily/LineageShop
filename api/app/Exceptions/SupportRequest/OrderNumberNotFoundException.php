<?php

declare(strict_types=1);

namespace App\Exceptions\SupportRequest;

use Throwable;
use App\Exceptions\BaseException;

final class OrderNumberNotFoundException extends BaseException
{
    public function __construct($message = 'Order number not found', $code = 422, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
