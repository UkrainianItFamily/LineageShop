<?php

declare(strict_types=1);

namespace App\Exceptions\Chat;

use Throwable;
use App\Exceptions\BaseException;

final class ChatNotFoundException extends BaseException
{
    public function __construct($message = 'Chat not found', $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
