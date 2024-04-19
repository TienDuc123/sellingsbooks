<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
class ShareUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $customer = $user ? $user->roles->contains('name', 'User') : false;
        $admin = $user ? $user->roles->contains('name', 'Admin') : false;

        View::share(['customer' => $customer, 'admin' => $admin]);

        return $next($request);
    }
}
