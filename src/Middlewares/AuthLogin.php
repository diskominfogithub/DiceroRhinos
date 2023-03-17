<?php

use Diskominfo\Middlewares;

use Closure;


class AuthLogin
{
    public function handle($request, Closure $next)
    {
        $isLogin = $request->session()->get('user.is_login');
        if ($isLogin) {
            return $next($request);
        }

        return redirect()
            ->route("view_login")
            ->with("pesan", "login terlebih dahulu");
    }
}
