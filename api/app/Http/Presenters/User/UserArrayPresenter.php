<?php

declare(strict_types=1);

namespace App\Http\Presenters\User;

use App\Models\User;
use Illuminate\Support\Collection;
use App\Http\Presenters\CollectionAsArrayPresenterInterface;

final class UserArrayPresenter implements CollectionAsArrayPresenterInterface
{
    public function present(User $user): array
    {
        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'login' => $user->getLogin(),
            'userPhoto' => $user->getUserPhoto(),
            'online' => $user->getOnline(),
            'confirmSendEmail' => $user->getConfirmSendEmail(),
            'passwordResetAdmin' => $user->getPasswordResetAdmin(),
            'createdAt' => $user->getCreatedAt(),
        ];
    }

    public function presentCollection(Collection $collection): array
    {
        return $collection
            ->map(
                function (User $user) {
                    return $this->present($user);
                }
            )
            ->all();
    }
}
