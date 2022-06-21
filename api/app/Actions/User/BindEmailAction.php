<?php

declare(strict_types=1);

namespace App\Actions\User;

use Auth;
use App\Models\EmailToken;
use Illuminate\Support\Str;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\EmailToken\EmailTokenRepositoryInterface;

final class BindEmailAction
{
    private UserRepositoryInterface $userRepositoryInterface;
    private EmailTokenRepositoryInterface $emailTokenRepositoryInterface;

    public function __construct(
        EmailTokenRepositoryInterface $emailTokenRepositoryInterface,
        UserRepositoryInterface $userRepositoryInterface
    ) {
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->emailTokenRepositoryInterface = $emailTokenRepositoryInterface;
    }

    public function execute(BindEmailRequest $request): void
    {
        $emailToken = $this->emailTokenRepositoryInterface->getByUserId(Auth::id());

        $token = sha1(Str::random(60));

        if ($emailToken) {
            $emailToken->token = $token;
            $emailToken->email = $request->getEmail();

            $this->emailTokenRepositoryInterface->update($emailToken);
        } else {
            $newEmailToken = new EmailToken;
            $newEmailToken->user_id = Auth::id();
            $newEmailToken->token = $token;
            $newEmailToken->email = $request->getEmail();

            $this->emailTokenRepositoryInterface->save($newEmailToken);
        }

        $user = $this->userRepositoryInterface->getById(Auth::id());

        $user->sendBindEmail($token, $request->getEmail());
    }
}
