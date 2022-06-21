<?php

declare(strict_types=1);

namespace App\Exceptions;

final class ErrorCode
{
    public const UNKNOWN_EXCEPTION = 1000;
    public const USER_ALREADY_VERIFIED_EXCEPTION = 1001;
    public const USER_NOT_AUTHORIZED_EXCEPTION = 1002;
    public const CHAT_ALREADY_CREATED_EXCEPTION = 1003;
    public const INVALID_OR_EXPIRED_TOKEN = 1004;
    public const PASSED_USER_PASSWORD_NOT_MATCH_CURRENT = 1005;
    public const WALLET_NOT_BELONG_TO_CURRENT_USER = 1006;
    public const EMAIL_TOKEN_NOT_MATCH = 1007;
    public const TOKEN_EXPIRED = 1007;
    public const USER_IS_NOT_ADMINISTRATOR = 1008;
    public const ORDER_NOT_BELONG_CURRENT_USER = 1009;
    public const ORDER_REQUEST_LIMIT_EXCEEDED = 1010;
}
