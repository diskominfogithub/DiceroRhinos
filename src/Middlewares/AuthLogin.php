<?php

namespace App\Http\Middleware;

use Closure;


class AuthLogin {
    public function handle($request , Closure $next){
        $isLogin = $request->session()->get('is_login');
        if($isLogin){
            return $next($request);
        }

        return redirect()
            ->route("view_login")
            ->with("pesan","login terlebih dahulu");
    }
}