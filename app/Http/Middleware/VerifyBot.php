<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyBot
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $challenge = $request->input('hub_challenge');
        $verifyToken = $request->input('hub_verify_token');
        $mode = $request->input('hub_mode');

        if ($mode && $verifyToken) {
            if ($mode === 'subscribe' && $verifyToken === env('Verify_Token')) {
                return response($challenge, 200);
            } else {
                return response('Forbidden', 403);
            }
        }
        
        return $next($request);
    }
}
