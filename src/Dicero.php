<?php

namespace Diskominfo;

use Illuminate\Http\Request;

class Dicero  {

    public static function login(Request $req){
        dd([
            'all'=>$req->all(),
            'env'=>env('APP_KEY')
        ]);
    }

    public static function logout(){
        return "logout";
    }

    public static function assignUserToRole($userId, $roleId){
        return "assignUserToRole user id : {$userId} , role id : {$roleId}";
    }

    public static function newUser(){
        return "new user";
    }

    public static function newRole(){
        return "new role";
    }

    public static function getAuthenticatedUser(){
        return "user authenticated";
    }
}

