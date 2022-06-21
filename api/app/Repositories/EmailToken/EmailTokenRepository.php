<?php

namespace App\Repositories\EmailToken;

use App\Models\EmailToken;
use App\Repositories\BaseRepository;

class EmailTokenRepository extends BaseRepository implements EmailTokenRepositoryInterface
{
    public function save(EmailToken $emailToken): EmailToken
    {
        $emailToken->save();

        return $emailToken;
    }
    public function update(EmailToken $emailToken): EmailToken
    {
        $emailToken->update();

        return $emailToken;
    }

    public function getByToken(string $token): ?EmailToken
    {
        return EmailToken::firstWhere('token', $token);
    }

    public function getByUserId(int $userId): ?EmailToken
    {
        return EmailToken::firstWhere('user_id', $userId);
    }
}
