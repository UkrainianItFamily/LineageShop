<?php

namespace App\Actions\Auth;

use Auth;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\User\UserNotFoundException;
use App\Repositories\User\UserRepositoryInterface;

final class LoginAction
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(LoginRequest $request): LoginResponse
    {
        $userByEmail = $this->userRepository->getByEmail($request->getEmail());

        if (!$userByEmail) {
            throw new UserNotFoundException('No account exists for '.$request->getEmail());
        }

        $credentials = [
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
        ];

        $token = $this->guard()->attempt($credentials);


        if (!$token) {
            throw new AuthenticationException('Invalid email or password');
        }

        return new LoginResponse(
            $token,
            'bearer',
            auth()->factory()->getTTL() * 1440
        );
    }

    private function guard()
    {
        return Auth::guard();
    }
}
