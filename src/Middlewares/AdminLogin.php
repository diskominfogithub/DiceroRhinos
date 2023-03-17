<?php


namespace Diskominfo\Middlewares;

use Closure;


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

        return redirect()
            ->route("view_login")
            ->with("pesan", "anda harus login sebagai admin terlebih dahulu");
    }
}
