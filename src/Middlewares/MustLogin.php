<?php


namespace Diskominfo\Middleware;

use Closure;

class MustLogin
{
    // Opd Login , check session
    public function handle($request, Closure $next)
    {
        $isOpd = $request
            ->session()
            ->get('user.is_opd');

        if ($isOpd) {
            return $next($request);
        }
        return redirect()
            ->route("view_login")
            ->with("pesan", "login sebagai opd terlebih dahulu");
    }
}
