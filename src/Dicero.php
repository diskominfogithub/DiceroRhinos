<?php

namespace Diskominfo;

use Diskominfo\Model\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Dicero  {

    /*
        Dicero::login(Request $req)
        login function, we can use this function
        when we want to login

        // required form parameters
        // username: string
        // password: string
        // required form parameters
    */
    public static function login(){
        $getUser = User::find(request()->username);
        
        // if user not exists in database
        // throw new Exception...
        if(!$getUser){
            $username = request()->username();
            throw new Exception("User dengan {$username} tidak ditemukan");
        }

        // next
        // check $req->password
        // and validate it against hashed password in database
        $result = Hash::check(request()->password,$getUser->password);

        // if result === false
        // invalid password
        if(!$result){
            throw new Exception("Error, Username atau password yang anda masukkan salah");
        }

        // if result === true
        // valid username and password
        // set $getUser into user's session
        request()->session('user',[
            'username'=>$getUser->username,
            'roles'=>$getUser->getRoles(),
            'opd'=>$getUser->getOpd()
        ]); 
    }

    /*
        Dicero::logout(Request $req)  
        logout authenticated user

        no form parameters required
    */
    public static function logout(){
        request()->session()->forget("user");
        return redirect()
            ->route(env('DEFAULT_REDIRECT_PAGE'))
            ->with("pesan","Anda berhasil logout");
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


    /*
        Dicero::getAuthenticatedUser()
        get current authenticated user from session
    */
    public static function getAuthenticatedUser(){
        return session('user');
    }
}

