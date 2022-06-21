<?php

declare(strict_types=1);

namespace App\Exceptions\User;

use App\Exceptions\ErrorCode;
use App\Exceptions\BaseException;

class AccessDeniedException extends BaseException
{
    protected $message = 'Access denied!';

    protected $code = ErrorCode::USER_IS_NOT_ADMINISTRATOR;
}
