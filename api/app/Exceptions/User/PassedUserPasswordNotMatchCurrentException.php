<?php

declare(strict_types=1);

namespace App\Exceptions\User;

use App\Exceptions\BaseException;
use App\Exceptions\ErrorCode;

class PassedUserPasswordNotMatchCurrentException extends BaseException
{
    protected $message = 'The password sent by the user does not match the current one';

    protected $code = ErrorCode::PASSED_USER_PASSWORD_NOT_MATCH_CURRENT;
}
