<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use App\Constant\UserRoleConstant;
use App\Exceptions\User\AccessDeniedException;

class IsAdministratorChecker
{
    public function handle(Request $request, Closure $next)
    {
        $authUserRole = Auth::user()->userRole->getType();

        if ($authUserRole !== UserRoleConstant::ADMINISTRATOR &&
            $authUserRole !== UserRoleConstant::SUPER_ADMINISTRATOR) {
            throw new AccessDeniedException();
        }

        return $next($request);
    }
}
