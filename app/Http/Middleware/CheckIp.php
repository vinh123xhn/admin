<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Danh sách các IP được phép
        $allowedIps = ['222.252.14.92', '222.252.8.27', '118.70.146.77', '127.0.0.1', '103.82.28.104']; // Thay đổi IP theo yêu cầu
        $ip = $request->header('x-forwarded-for', $request->ip());

        if (!in_array($ip, $allowedIps)) {
            // Nếu IP không nằm trong danh sách cho phép, trả về lỗi 403
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}

