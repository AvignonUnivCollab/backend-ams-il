<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('pages.login')->with('error', 'Accès refusé. Vous devez être administrateur.');
        }

        return $next($request);
    }
}
