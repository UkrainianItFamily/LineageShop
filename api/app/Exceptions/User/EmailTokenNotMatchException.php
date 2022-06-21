<?php

namespace App\Exceptions\User;

use App\Exceptions\BaseException;
use App\Exceptions\ErrorCode;

class EmailTokenNotMatchException extends BaseException
{
    protected $message = 'Email token not match!';

    protected $code = ErrorCode::EMAIL_TOKEN_NOT_MATCH;
}
