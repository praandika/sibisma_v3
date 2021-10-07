<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Leasing;
use DB;
use Carbon;

class LeasingController extends Controller
{
    public function index(){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	$title = "Daftar Leasing";
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $data = Leasing::orderBy('nama_leasing','asc')->get();
            
            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

        	return view('leasing.data_leasing', compact('title','data','now','data_user','count_user'));
        }
    }

    public function store(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	DB::table('leasings')->insert([
                'nama_leasing' => $req->nama,
            ]);
            toast('Data berhasil di tambah','success');
            return redirect('leasing/');
        }
    }

    public function update(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	DB::table('leasings')->where('id_leasing',$req->id)->update([
                'nama_leasing' => $req->nama,
            ]);
            toast('Data berhasil di tambah','success');
            return redirect('leasing/');
        }
    }

    public function delete(Request $req){
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            $delid = $req->input('pilih');
            DB::table('leasings')->whereIn('id_leasing',$delid)->delete();
            toast('Data berhasil di hapus','success');
            return redirect('leasing/');
        }
    }
}
