<?php

declare(strict_types=1);

namespace App\Exceptions\Order;

use App\Exceptions\ErrorCode;
use App\Exceptions\BaseException;

class RequestLimitExceeded extends BaseException
{
    protected $message = 'Request limit exceeded! Reduce the quantity of the purchased item';

    protected $code = ErrorCode::ORDER_REQUEST_LIMIT_EXCEEDED;
}
