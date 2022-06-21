<?php

declare(strict_types=1);

namespace App\Exceptions\EmailToken;

use Throwable;
use App\Exceptions\BaseException;

final class EmailTokenNotFoundException extends BaseException
{
    public function __construct($message = 'Email token not found', $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
