<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ==== urutan pengecekan penting disini ====
        // pertama cek apakah sudah login apa belum
        // jika sudah login, apakah orang tsb. adalah admin apa bukan
        if (auth()->guest() || !auth()->user()->isadmin) {
            abort(403, "F0rB1dd3N");
        }

        return $next($request);
    }
}
