<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Exceptions\User\UserNotFoundException;
use App\Repositories\User\UserRepositoryInterface;

final class GetUserByIdAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(GetUserByIdRequest $request): GetUserByIdResponse
    {
        $user = $this->userRepository->getById($request->getId());

        if (!$user) {
            throw new UserNotFoundException();
        }

        return new GetUserByIdResponse($user);
    }
}
