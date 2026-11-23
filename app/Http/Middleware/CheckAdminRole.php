<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        if (auth()->check() && $request->routeIs('dashboard')) {
            if (auth()->user()->role === 'technician') {
                return redirect()->route('technician.dashboard');
            }

            if (auth()->user()->role === 'customer') {
                return redirect()->route('customer.dashboard');
            }
        }

        abort(403, 'Unauthorized - Admin access only');
    }
}
