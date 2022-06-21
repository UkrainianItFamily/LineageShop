<?php

namespace App\Exceptions\Auth;

use App\Exceptions\ErrorCode;
use App\Exceptions\BaseException;

class InvalidOrExpiredToken extends BaseException
{
    protected $message = 'Invalid or expired token for password reset';
    protected $code = ErrorCode::INVALID_OR_EXPIRED_TOKEN;
}
