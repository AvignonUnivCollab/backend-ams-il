<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // For API requests expecting JSON, return null to prevent redirection
        if (!$request->expectsJson()) {
            return route('login');
        }

        // If it's a JSON request and user is not authenticated, send a 401 Unauthorized response
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
