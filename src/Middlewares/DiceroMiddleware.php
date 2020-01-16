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
    public function handle($request , Closure $next){
        $user = $request->session('user');


        if($user){
            return redirect()
                ->route("home")
                ->with("pesan","With user");
        } else {
            return redirect()
                ->route("home")
                ->with("pesan","Without user");
        }
        // if(!$user) {
        //     return redirect()
        //         ->route(env('DEFAULT_REDIRECT_PAGE'))
        //         ->with("pesan","Anda belum login");
        // }

        // $username = $user->username;
        // $roles = $user->getRoles();
        // $route = $request->route();
        
        // $middlewares = $route->middleware();
        // $isExists = false;

        // $roles = array_map(function($v){
        //     return $v->role_name;
        // },$roles);


        // if($isExists) { 
        //     return $next($request) ;
        // }else {
        //     return redirect()
        //         ->route(env('DEFAULT_REDIRECT_PAGE'))
        //         ->with("pesan","Username : {$username} tidak berhak mengakses halaman ini");  
        // } 
    }
}