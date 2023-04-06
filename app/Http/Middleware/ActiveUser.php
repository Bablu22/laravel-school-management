<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ActiveUser
{
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param StatefulGuard $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->status === 0) {
            $this->guard->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return $next($request);
    }
}
