<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\FakturService;
use DB;
use Carbon;

class FSController extends Controller
{
	public function index($home = null){
		if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	$title = "Catat Faktur dan Service";
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $tahun = \Carbon\Carbon::now('GMT+8')->format('Y');
            $bulan = \Carbon\Carbon::now('GMT+8')->format('m');
            if ($home != null) {
                $data = FakturService::orderBy('tanggal_fs','desc')
                ->where('dealer_kode',$home)
                ->whereYear('tanggal_fs',$tahun)
                ->whereMonth('tanggal_fs',$bulan)
                ->get();
            }else{
                $data = FakturService::orderBy('tanggal_fs','desc')
                ->whereYear('tanggal_fs',$tahun)
                ->whereMonth('tanggal_fs',$bulan)
                ->get();
            }

            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();
        	
        	return view('fs.data_fs', compact('title','data','now','data_user','count_user'));
        }
	}

	public function store(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	DB::table('faktur_services')->insert([
                'tanggal_fs' => $req->tanggal,
                'faktur' => $req->faktur,
                'service' => $req->service,
                'dealer_kode' => $req->dealer
            ]);
            toast('Data berhasil di tambah','success');
            return redirect('fands/');
        }
    }

    public function update(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	DB::table('faktur_services')->where('id_fs',$req->id)->update([
                'tanggal_fs' => $req->tanggal,
                'faktur' => $req->faktur,
                'service' => $req->service,
                'dealer_kode' => $req->dealer
            ]);
            toast('Data berhasil di tambah','success');
            return redirect('fands/');
        }
    }

    public function delete(Request $req){
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            $delid = $req->input('pilih');
            DB::table('faktur_services')->whereIn('id_fs',$delid)->delete();
            toast('Data berhasil di hapus','success');
            return redirect('fands/');
        }
    }
}
