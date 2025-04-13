<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserId
{
    public function handle(Request $request, Closure $next)
    {
        $requestedId = $request->route('id'); // ambil parameter id dari URL
        $loggedInId = Auth::id(); // ambil ID user yang sedang login

        if ($loggedInId != $requestedId) {
            abort(403, 'Akses ditolak. Ini bukan akun Anda.');
        }

        return $next($request);
    }
}
