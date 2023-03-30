<?php

namespace Diskominfo\Middlewares;

use Closure;
use RealRashid\SweetAlert\Facades\Alert;

class DiceroMiddleware
{


    // check against current user's session

    // if exists
    // then continue...
    // check if this user's role, can access this route ?


    // else
    // redirect back to default redirect page
    public function handle($request, Closure $next, ...$roles)
    {
        $user = $request->session()->get('user');

        if (!$user) {
            Alert::warning("Gagal", "Anda belum login");
            return redirect()->back();
        }

        $username = $user['username'];
        $currentUserRole = $user['role']['nama_role'];
        $isExists = array_search($currentUserRole, $roles);

        if (gettype($isExists) === "boolean" && $isExists === FALSE) {
            Alert::warning("Gagal", "Username : {$username} tidak berhak mengakses halaman ini");
            return redirect()->back();
        }

        return $next($request);
    }
}
