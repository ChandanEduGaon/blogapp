<?php

namespace App\Http\Middleware;

use App\Models\UserActivity;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        try {
            $user = Auth::user();
            $route = $request->path();
            $ip = $request->ip();
            $method = $request->method();

            // Store activity to database
            if ($user) {
                UserActivity::create([
                    'user_id' => $user->id,
                    'route' => $route,
                    'method' => $method,
                    'ip_address' => $ip,
                ]);
            } else {
                // Log guests in log file
                Log::info('Guest accessed: ' . $route, [
                    'ip' => $ip,
                    'method' => $method,
                ]);
            }
        } catch (\Throwable $th) {
            Log::error('Failed to log activity: ' . $th->getMessage());
        }

        return $response;
    }
}
