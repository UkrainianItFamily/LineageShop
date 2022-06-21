<?php

declare(strict_types=1);

namespace App\Exceptions\Category;

use App\Exceptions\BaseException;

final class CategoryNotFoundException extends BaseException
{
    public function __construct($message = 'Category not found', $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
