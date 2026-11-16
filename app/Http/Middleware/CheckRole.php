<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman ini.');
        }

        $user = auth()->user();

        if (!$user->status_aktif) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'Akun Anda sedang dinonaktifkan. Hubungi sekretariat paroki.');
        }

        if (!empty($roles) && !$user->hasRole($roles)) {
            abort(403, 'Akses Ditolak: Anda tidak memiliki izin untuk mengakses modul ini.');
        }

        return $next($request);
    }
}

