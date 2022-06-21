<?php

declare(strict_types=1);

namespace App\Exceptions\User;

use App\Exceptions\BaseException;
use App\Exceptions\ErrorCode;

class UserAlreadyVerifiedException extends BaseException
{
    protected $message = 'User already verified!';

    protected $code = ErrorCode::USER_ALREADY_VERIFIED_EXCEPTION;
}
