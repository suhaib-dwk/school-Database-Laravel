<?php

namespace App\Http\Middleware;

use App\Models\Student;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    public function handle(Request $request, Closure $next,...$roles): Response
    {
        $user = Auth::user();

        if (!$user) {
            return response('Unauthorized', 401);
        }

        if (in_array($user->user_type, $roles)) {
            return response('Forbidden', 403);
        }

        return $next($request);
    }
}
