<?php

declare(strict_types=1);

namespace App\Exceptions\UserWallet;

use App\Exceptions\ErrorCode;
use App\Exceptions\BaseException;

final class WalletNotBelongToCurrentUserException extends BaseException
{
    protected $message = 'Wallet not belong to current user';

    protected $code = ErrorCode::WALLET_NOT_BELONG_TO_CURRENT_USER;

}
