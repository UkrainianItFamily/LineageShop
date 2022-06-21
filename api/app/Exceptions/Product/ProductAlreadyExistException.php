<?php

declare(strict_types=1);

namespace App\Exceptions\Product;

use Throwable;
use App\Exceptions\BaseException;

final class ProductAlreadyExistException extends BaseException
{
    public function __construct($message = 'Product already exist', $code = 422, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
