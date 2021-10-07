<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Warna;
use DB;
use Carbon;

class WarnaController extends Controller
{
    public function store(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	DB::table('warnas')->insert([
                'warna' => $req->warna,
            ]);
            toast('Data berhasil di tambah','success');
            return redirect('unit/');
        }
    }

    public function update(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	DB::table('warnas')->where('id_warna',$req->id)->update([
                'warna' => $req->warna,
            ]);
            toast('Data berhasil di tambah','success');
            return redirect('unit/');
        }
    }

    public function delete(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	$delid = $req->input('check');
            DB::table('warnas')->whereIn('id_warna',$delid)->delete();
            toast('Data berhasil di hapus','success');
            return redirect('unit/');
        }
    }
}
