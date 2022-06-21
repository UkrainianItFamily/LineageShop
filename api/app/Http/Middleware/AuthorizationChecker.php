<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use App\Exceptions\User\UserNotAuthorizedException;

class AuthorizationChecker
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::id()) {
            throw new UserNotAuthorizedException();
        }

        return $next($request);
    }
}
