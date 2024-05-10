<?php


namespace Diskominfo\Middlewares;

use Closure;
use RealRashid\SweetAlert\Facades\Alert;

class AuthLogin
{
    public function handle($request, Closure $next)
    {
        $isLogin = $request->session()->get('user.is_login');
        if ($isLogin) {
            return $next($request);
        }

        Alert::error('Login Gagal!', 'Username atau Password Salah!');
        return redirect()
            ->route("view_login");
    }
}
