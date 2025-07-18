<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Vui lòng đăng nhập để tiếp tục!');
        }

        $user = Auth::user();
        if ($user->role !== $role) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập!');
        }

        return $next($request);
    }
}