<?php

declare(strict_types=1);

namespace App\Exceptions\Product;

use Throwable;
use App\Exceptions\BaseException;

final class ProductNotFoundException extends BaseException
{
    public function __construct($message = 'Product not found', $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
