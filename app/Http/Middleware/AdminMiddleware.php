<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Cek role admin
        if (Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Jika bukan admin
        abort(403, 'Halaman ini hanya untuk Administrator.');
    }
}