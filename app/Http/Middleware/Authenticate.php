<?php

namespace App\Http\Middleware;

use App\Exceptions\LoginException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     * @param Request $request
     * @return string|null
     * @throws LoginException
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : throw new LoginException();
    }
}
