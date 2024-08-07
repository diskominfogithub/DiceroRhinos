<?php

namespace Diskominfo;

use Diskominfo\Model\Opd;
use Diskominfo\Model\Role;
use Diskominfo\Model\User;
use Exception;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Dicero
{

    /*
        Dicero::login(Request $req)
        login function, we can use this function
        when we want to login

        // required form parameters
        // username: string
        // password: string
        // required form parameters
    */
    public static function login(
        $formParamUsername,
        $formParamPassword
    ) {
        $getUser = User::where('username', $formParamUsername)->first();

        // if user not exists in database
        // throw new Exception...
        if (!$getUser) {
            throw new Exception("User dengan {$formParamUsername} tidak ditemukan");
        }

        // next
        // check $req->password
        // and validate it against hashed password in database
        $result = Hash::check($formParamPassword, $getUser->password);

        // if result === false
        // invalid password
        if (!$result) {
            throw new Exception("Error, Username atau password yang anda masukkan salah");
        }

        // if result === true
        // valid username and password
        // set $getUser into user's session

        $getUserRole = $getUser->getRole ? $getUser->getRole : null;
        $getUserOpd = $getUser->getOpd ? $getUser->getOpd : null;

        $idOpd = $getUser->id_opd;
        $nama = $getUser->username;

        if ($idOpd) {
            session([
                'user' => [
                    "id_user" => $getUser->id_user,
                    "nik" => $getUser->nik,
                    "username" => $getUser->username,
                    "nip" => $getUser->nip,
                    "nama" => $getUser->nama,
                    "jenis_kelamin" => $getUser->jenis_kelamin,
                    "tempat_lahir" => $getUser->tempat_lahir,
                    "tgl_lahir" => $getUser->tgl_lahir,
                    "alamat" => $getUser->alamat,
                    "role" => $getUserRole,
                    "opd" => $getUserOpd,
                    "is_login" => \true,
                    "is_opd" => \true
                ]
            ]);
        } else {

            session([
                'user' => [
                    "id_user" => $getUser->id_user,
                    "nik" => $getUser->nik,
                    "username" => $getUser->username,
                    "nip" => $getUser->nip,
                    "nama" => $getUser->nama,
                    "jenis_kelamin" => $getUser->jenis_kelamin,
                    "tempat_lahir" => $getUser->tempat_lahir,
                    "tgl_lahir" => $getUser->tgl_lahir,
                    "alamat" => $getUser->alamat,
                    "role" => $getUserRole,
                    "opd" => $getUserOpd,
                    "is_login" => \true,
                    "is_admin" => \true
                ]
            ]);
        }
    }

    /*
        Dicero::logout(Request $req)
        logout authenticated user

        no form parameters required
    */
    public static function logout()
    {
        request()->session()->forget("user");
        return redirect()
            ->route(config('dicero.default_redirect_page'))
            ->with("pesan", "Anda berhasil logout");
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
    public static function newUser($newUser)
    {
        $username = $newUser->username;
        $password = $newUser->password;
        $email = $newUser->email;


        try {
            $role = Role::find($newUser->role_id);
            $opd = Opd::find($newUser->opd_id);

            $user = new User();
            $user->username = $username;
            $user->password = Hash::make($password);
            $user->email = $email;
            $user->getRole()->associate($role);
            $user->getOpd()->associate($opd);
            $result = $user->save();

            return $result;
        } catch (Exception $ex) {
            throw new Exception("Terjadi error, {$ex->getMessage()}");
        }
    }



    /*
        Dicero::newRole()
        create new role

        // form parameters required
            nama_role
    */
    public static function newRole(
        $reqNamaRole
    ) {
        try {
            $role = new Role();
            $role->nama_role = $reqNamaRole;
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
    public static function newOpd($reqNamaOpd)
    {
        try {
            $opd = new Opd();
            $opd->nama_opd = $reqNamaOpd;
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
    public static function getAuthenticatedUser()
    {
        return self::userObject();
    }

    public static function getUserRole()
    {
        return self::userObject()->role;
    }

    private static function userObject()
    {
        $toJson = json_encode(session('user'));
        return json_decode($toJson);
    }

    public static function getUserOpd()
    {
        return self::userObject()->opd;
    }

    public static function getuser()
    {
        $user = session('user');
        return $user;
    }

    public static function getAllUser()
    {
        $user = User::all()->where('id_role', '!=', 1);

        return $user;
    }
}
