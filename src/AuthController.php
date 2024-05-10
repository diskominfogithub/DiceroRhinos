<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\IsiTabel;
use App\Models\JenisTabel;
use App\Models\Opd;
use App\Models\User;
use Diskominfo\Dicero;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use stdClass;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class AuthController extends Controller
{

    public function viewLogin()
    {
        return view("auth.login", [
            "title" => "Login user"
        ]);
    }

    public function submitLogin(Request $req)
    {
        try {
            Dicero::login($req->username, $req->password);
            Alert::success('Login Berhasil!', 'Anda Telah Login');

            return redirect()->route('dashboard.opd');
        } catch (Exception $ex) {
            Alert::error('Login Gagal!', 'Username atau Password Salah!');
            return redirect()
                ->back();
        }
    }

    public function viewRegister($id_opd = null)
    {
        $opdBelumTerpakai = DB::table("opd")
            ->get("opd.*");

        return view("register", [
            "title" => "Register user untuk opd",
            "opd_belum_pakai" => $opdBelumTerpakai,
            "id_opd" => $id_opd
        ]);
    }

    public function viewListOpdJson()
    {
        $listAllOpd = DB::table('opd')->get();

        return DataTables::of($listAllOpd)
            ->addColumn('action', function ($row) {
                $html = '<a href="#" class="btn btn-sm btn-warning">Edit</a> ';
                $html .= '<a href="/ktp/destroy/' . $row->id_opd . '" data-rowid="' . $row->id_opd . '" class="btn btn-sm btn-danger">Del</a>';
                return $html;
            })->toJson();;
    }

    public function viewListOpd()
    {
        $listAllOpd = DB::select(DB::raw("
        SELECT DISTINCT o.id_opd, o.nama_opd, u.username,
        (SELECT COUNT(id_user) FROM users WHERE id_opd = o.id_opd) AS jumlah_admin
        FROM opd o
        LEFT JOIN users u ON u.id_opd = o.id_opd
    "));

        return view("list_opd", compact("listAllOpd"), [
            "title" => "List seluruh OPD"
        ]);
    }

    public function viewBuatOpd()
    {
        return view("buat_opd", [
            'title' => "Tambah opd baru"
        ]);
    }


    public function submitBuatOpd(Request $req)
    {
        try {
            $newOpd = new Opd();
            $newOpd->nama_opd = $req->nama_opd;
            $newOpd->save();

            Alert::success('Berhasil!', 'Berhasil Input SKPD');
            return redirect()
                ->back();
        } catch (Exception $ex) {
            Alert::warning('Gagal!', 'Gagal Input SKPD');
            return redirect()
                ->back();
        }
    }

    public function submitRegister(Request $req)
    {
        $newUser = new User();

        $newUser->username = $req->username;
        $newUser->password = Hash::make($req->password);
        $newUser->id_opd = $req->id_opd;
        $newUser->save();

        Alert::success('Berhasil!', 'Berhasil Daftar Admin');
        return redirect()
            ->back();
    }


    public function logout(Request $req)
    {
        $req->session()->flush();
        return redirect()
            ->route("view_login")
            ->with("pesan", "Anda berhasil logout");
    }

    public function list_admin()
    {
        $get_user = User::all()->where("id_opd", "!=", null);

        return \view('list_admin', ['title' => 'List Admin'], \compact('get_user'));
    }

    public function viewGantiPassword(Request $req)
    {
        $idOpd = $req->session()->get("user.id_user");
        $user = User::where("id_user", $idOpd)->first();

        return view("ganti_pass", compact('user'), [
            'title' => 'Ganti password'
        ]);
    }

    public function submitGantiPassword(Request $req)
    {
        try {
            $pass_baru = $req->pass_baru;
            $conf_pass_baru = $req->conf_pass_baru;

            if ($conf_pass_baru != $pass_baru) {
                return redirect()
                    ->back()
                    ->with("pesan", "Konfirmasi password tidak sama");
            }

            $getUser = User::find($req->user_id);
            $getUser->password = Hash::make($conf_pass_baru);

            $getUser->save();

            Alert::success('Berhasil Diupdate!', 'Password Berhasil Update!');
            return redirect()
                ->back()
                ->with("pesan", "Ubah password berhasil");
        } catch (Exception $ex) {
            Alert::warning('Gagal Diupdate!', 'Ulangi Lagi!');
            return redirect()
                ->back()
                ->with("pesan", "Ubah password gagal");
        }
    }
}
