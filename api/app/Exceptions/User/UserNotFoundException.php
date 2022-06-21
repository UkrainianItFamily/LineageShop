<?php

declare(strict_types=1);

namespace App\Exceptions\User;

use App\Exceptions\BaseException;

final class UserNotFoundException extends BaseException
{
    public function __construct($message = 'User not found', $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
