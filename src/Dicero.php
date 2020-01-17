<?php

namespace Diskominfo;

use Diskominfo\Model\Opd;
use Diskominfo\Model\Role;
use Diskominfo\Model\User;
use Exception;
// use Illuminate\Http\Request;
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
        $getUser = User::where('username',request()->username)->first();
        
        // if user not exists in database
        // throw new Exception...
        if(!$getUser){
            $username = request()->username;
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
        session([
            'user'=>[
                'username'=>$getUser->username,
                "role"=>$getUser->getRole(),
                "opd"=>$getUser->getOpd()
            ]
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

    /*
        Dicero::newUser()
        create new user based on role_id and opd_id

        // form parameter required
            username
            password
            email
            role_id
            opd_id
    */
    public static function newUser(){
        $req = request();

        $username = $req->username;
        $password = $req->password;
        $email = $req->email;

        
        try{
            $role = Role::find($req->role_id);
            $opd = Opd::find($req->opd_id);
    
            $user = new User();
            $user->username = $username;
            $user->password = Hash::make($password);
            $user->email = $email;
            $user->getRole()->associate($role);
            $user->getOpd()->associate($opd);
            $result = $user->save();

            return $result;
        }catch(Exception $ex){
            throw new Exception("Terjadi error, {$ex->getMessage()}");
        }
    }


    
    /*
        Dicero::newRole()
        create new role

        // form parameters required
            nama_role
    */
    public static function newRole(){
        $req = request();

        try {
            $role = new Role();
            $role->nama_role = $req->nama_role;
            $result = $role->save();
            return $result;
        } catch (Exception $ex) {
            throw new Exception("Terjadi error, {$ex->getMessage()}");
        }
        
    }


    /*
        Dicero::newOpd()
        create new opd

        // form parameters required
            nama_opd
    */
    public static function newOpd(){
        $req = request();

        try {
            $opd = new Opd();
            $opd->nama_opd = $req->nama_opd;
            $result = $opd->save();
            return $result;
        } catch (Exception $ex) {
            throw new Exception("Terjadi error, {$ex->getMessage()}");
        }
    }

    /*
        Dicero::getAuthenticatedUser()
        get current authenticated user from session
    */
    public static function getAuthenticatedUser(){
        return session('user');
    }
}

