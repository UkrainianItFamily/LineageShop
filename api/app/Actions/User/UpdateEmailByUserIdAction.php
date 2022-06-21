<?php

declare(strict_types=1);

namespace App\Actions\User;

use Carbon\Carbon;
use App\Constant\EmailTokenConstant;
use App\Exceptions\User\TokenExpiredException;
use App\Repositories\User\UserRepositoryInterface;
use App\Exceptions\EmailToken\EmailTokenNotFoundException;
use App\Repositories\EmailToken\EmailTokenRepositoryInterface;

final class UpdateEmailByUserIdAction
{
    private UserRepositoryInterface $userRepositoryInterface;
    private EmailTokenRepositoryInterface $emailTokenRepositoryInterface;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface,
        EmailTokenRepositoryInterface $emailTokenRepositoryInterface
    ) {
        $this->userRepositoryInterface = $userRepositoryInterface;
        $this->emailTokenRepositoryInterface = $emailTokenRepositoryInterface;
    }

    public function execute(UpdateEmailByUserIdRequest $request): UpdateEmailByUserIdResponse
    {
        $emailToken = $this->emailTokenRepositoryInterface->getByToken($request->getToken());

        if (!$emailToken) {
            throw new EmailTokenNotFoundException();
        }

        if (Carbon::parse($emailToken->getUpdatedAt())->lt(Carbon::now()->subMinutes(EmailTokenConstant::EXPIRES))) {
            throw new TokenExpiredException();
        }

        $user = $this->userRepositoryInterface->getById($emailToken->getUserId());

        $user->email = $emailToken->getEmail();

        $user = $this->userRepositoryInterface->update($user);

        return new UpdateEmailByUserIdResponse($user);
    }
}
