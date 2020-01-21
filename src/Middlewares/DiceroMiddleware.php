<?php

namespace Diskominfo\Middleware;
use Closure;

class DiceroMiddleware {
    

    // check against current user's session
    
    // if exists
    // then continue...
    // check if this user's role, can access this route ?


    // else
    // redirect back to default redirect page
    public function handle($request , Closure $next , ...$roles){
        $user = $request->session('user');

        if(!$user) {
            return redirect()
                ->route(config('dicero.default_redirect_page'))
                ->with("pesan","Anda belum login");
        }

        $username = $user->username;
        $currentUserRole = $user->getRole();
        $isExists = array_search($currentUserRole,$roles);

        if($isExists) { 
            return $next($request) ;
        }else {
            return redirect()
                ->route(config('dicero.default_redirect_page'))
                ->with("pesan","Username : {$username} tidak berhak mengakses halaman ini");  
        } 
    }
}