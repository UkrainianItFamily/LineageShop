<?php

declare(strict_types=1);

namespace App\Exceptions\Chat;

use App\Exceptions\BaseException;
use App\Exceptions\ErrorCode;

class ChatAlreadyCreatedException extends BaseException
{
    protected $message = 'Chat already created!';

    protected $code = ErrorCode::CHAT_ALREADY_CREATED_EXCEPTION;
}
