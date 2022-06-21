<?php

declare(strict_types=1);

namespace App\Exceptions;

final class ExampleException extends BaseException
{
    protected $message = 'Example exception';

    protected $code = ErrorCode::UNKNOWN_EXCEPTION;
}
