<?php

namespace App\Actions\Auth;

use Auth;

final class LogoutAction
{

    public function execute(): void
    {
        $this->guard()->logout();
    }

    private function guard()
    {
        return Auth::guard();
    }
}
