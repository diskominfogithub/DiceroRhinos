<?php


namespace Diskominfo\Middlewares;

use RealRashid\SweetAlert\Facades\Alert;
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

        Alert::error("pesan", "login sebagai opd terlebih dahulu");
        return redirect()
            ->route("view_login");
    }
}
