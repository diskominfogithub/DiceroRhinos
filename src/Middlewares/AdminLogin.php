<?php


namespace Diskominfo\Middlewares;

use Closure;
use RealRashid\SweetAlert\Facades\Alert;

class AdminLogin
{
    public function handle($request, Closure $next)
    {
        $isAdmin = $request
            ->session()
            ->get("user.is_admin");

        if ($isAdmin) {
            return $next($request);
        }

        Alert::error("pesan", "anda harus login sebagai admin terlebih dahulu");
        return redirect()
            ->route("view_login");
    }
}
