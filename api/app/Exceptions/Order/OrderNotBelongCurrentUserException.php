<?php

declare(strict_types=1);

namespace App\Exceptions\Order;

use App\Exceptions\ErrorCode;
use App\Exceptions\BaseException;

class OrderNotBelongCurrentUserException extends BaseException
{
    protected $message = 'The order does not belong to the current user!';

    protected $code = ErrorCode::ORDER_NOT_BELONG_CURRENT_USER;
}
