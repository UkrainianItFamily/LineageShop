<?php

namespace App\Exceptions\User;

use App\Exceptions\BaseException;
use App\Exceptions\ErrorCode;

class TokenExpiredException extends BaseException
{
    protected $message = 'Token expired!';

    protected $code = ErrorCode::TOKEN_EXPIRED;
}
