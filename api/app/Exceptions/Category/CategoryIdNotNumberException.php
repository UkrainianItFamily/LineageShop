<?php

declare(strict_types=1);

namespace App\Exceptions\Category;

use App\Exceptions\BaseException;

final class CategoryIdNotNumberException extends BaseException
{
    public function __construct(
        $message = 'Category id must be a number',
        $code = 404,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
