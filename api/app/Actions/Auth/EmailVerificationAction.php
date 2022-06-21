<?php

namespace App\Actions\Auth;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\User\UserAlreadyVerifiedException;

final class EmailVerificationAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(EmailVerificationRequest $request): void
    {
        $user = $this->userRepository->getById($request->getId());

        if (!hash_equals((string) $request->getHash(), sha1($user->getEmailForVerification()))) {
            throw new AuthenticationException('Unauthorized');
        }

        if (!$user->hasVerifiedEmail()) {
            $this->userRepository->markUserEmail($user);
        } else {
            throw new UserAlreadyVerifiedException();
        }
    }
}
