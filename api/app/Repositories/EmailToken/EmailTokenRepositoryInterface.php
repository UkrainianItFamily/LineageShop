<?php

namespace App\Repositories\EmailToken;

use App\Models\EmailToken;

interface EmailTokenRepositoryInterface
{
    public function save(EmailToken $emailToken): EmailToken;
    public function update(EmailToken $emailToken): EmailToken;
    public function getByToken(string $token): ?EmailToken;
    public function getByUserId(int $userId): ?EmailToken;
}
