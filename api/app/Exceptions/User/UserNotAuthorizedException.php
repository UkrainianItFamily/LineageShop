<?php

declare(strict_types=1);

namespace App\Exceptions\User;

use App\Exceptions\BaseException;
use App\Exceptions\ErrorCode;

class UserNotAuthorizedException extends BaseException
{
    protected $message = 'User not authorized!';

    protected $code = ErrorCode::USER_NOT_AUTHORIZED_EXCEPTION;
}
