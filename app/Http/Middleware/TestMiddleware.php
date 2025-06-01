<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Contoh sederhana: tambahkan header response
        $response = $next($request);
        $response->headers->set('X-Test-Middleware', 'MiddlewareWorks');
        return $response;
    }
}
