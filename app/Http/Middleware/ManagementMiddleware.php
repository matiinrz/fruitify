<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagementMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User $user */
        $user = auth('sanctum')->user();
        abort_if(empty($user) || $user->permission != 'superuser', 403, "شما به این بخش دسترسی ندارید");

        return $next($request);
    }
}
