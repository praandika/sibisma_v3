<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Keluar;
use App\Stok;
use App\Warna;
use App\Unit;
use DB;
use Carbon;

class OutController extends Controller
{
    public function keluar($tgl = null, $home = null){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{

            if ($home == "AA0101") {
                $title = "Stok Keluar Bisma Sentral";
                $dealer = "Bisma Sentral";
            }elseif ($home == "AA0102") {
                $title = "Stok Keluar Bisma Cokro";
                $dealer = "Bisma Cokro";
            }elseif ($home == "AA0104") {
                $title = "Stok Keluar Bisma Hasanuddin";
                $dealer = "Bisma Hasanuddin";
            }elseif ($home == "AA0105") {
                $title = "Stok Keluar Bisma TTS";
                $dealer = "Bisma TTS";
            }elseif ($home == "AA0106") {
                $title = "Stok Keluar Bisma Imam Bonjol";
                $dealer = "Bisma Imam Bonjol";
            }elseif ($home == "AA0107") {
                $title = "Stok Keluar Bisma Mandiri";
                $dealer = "Bisma Mandiri";
            }elseif ($home == "AA0108") {
                $title = "Stok Keluar Bisma WR Supratman";
                $dealer = "Bisma WR Supratman";
            }elseif ($home == "AA0109") {
                $title = "Stok Keluar Bisma Sunset Road";
                $dealer = "Bisma Sunset Road";
            }elseif ($home == "AA0104F") {
                $title = "Stok Keluar Flagship Shop";
                $dealer = "Flagship Shop";
            }else{
                $title = "Stok Keluar Error";
                $dealer = "Error";
            }

        	$now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
        	$warna = Warna::orderBy('warna','asc')->get();
            $stok = Stok::where('dealer_kode',$home)->sum('stok');
        	$unit = Unit::orderBy('nama_unit','asc')->get();
        	$data = Stok::orderBy('nama_motor','asc')->where('dealer_kode',$home)->get();
        	$keluar = DB::table('keluars')
        	->join('stoks','keluars.stok_id','=','stoks.id_stok')
        	->orderBy('tanggal_keluar','desc')
        	->where([ ['keluars.dealer_kode',$home], ['tanggal_keluar',$tgl] ])->get();
        	$total = DB::table('keluars')
        	->where([ ['dealer_kode',$home], ['tanggal_keluar',$tgl] ])
            ->sum('qty_out');
            
            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

        	return view('out.keluar',compact('title','dealer','data','keluar','warna','now','total','tgl','unit','stok','home','data_user','count_user'));
        }
    }

// CREATE==========================================================================================
    public function Ckeluar(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	if ($req->cabang == "") {
        		alert('Pilih Tujuan Cabang!','Data tidak lengkap!', 'warning')->persistent('OK');
	            return redirect('out/sentral')->with('auto', true)->withInput();
        	}else{
        		$qty = DB::table('stoks')
	        	->where('id_stok',$req->id_stok)
	        	->sum('stok');

	        	$klr = $req->qty;
	        	$stok = $qty-$klr;

	        	if ($klr > $qty) {
	        		alert('Stok Tidak Cukup!','Peringatan!', 'warning')->persistent('OK');
	        		return redirect()->back()->with('autofocus', true)->withInput();
	        	}else{
	        		DB::table('keluars')->insert([
		                'stok_id' => $req->id_stok,
		                'tanggal_keluar' => $req->tanggal,
		                'qty_out' => $req->qty,
		                'cabang' => $req->cabang,
		                'dealer_kode' => $req->kode_dealer,
		                'created_at' => \Carbon\Carbon::now('GMT+8')
		            ]);

		            DB::table('stoks')->where('id_stok',$req->id_stok)->update([
		                'stok' => $stok,
		                'updated_at' => \Carbon\Carbon::now('GMT+8')
		            ]);

                    $tgl = $req->tanggal;

                    $home = $req->kode_dealer;

                    $data = ['tanggal' => $tgl];

		            toast('Data berhasil di tambah','success');
		            return redirect('out/keluar/'.$tgl.'/'.$home.'')->with('input',$data)->withInput(
                    $req->except('unit','id_stok','jenis','tahun','warna','stok','qty','tanggal')
                );
	        	}
        	}
        }
    }

// DELETE ===============================================================================
    public function Delete($id){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	//Ambil ID Stok
        	$id_stok = DB::table('keluars')->where('id_keluar',$id)->sum('stok_id');
        	//Ambil Stok Terkini
        	$stok = DB::table('stoks')->where('id_stok',$id_stok)->sum('stok');
        	//Ambil Jumlah yang dihapus
        	$qty = DB::table('keluars')->where('id_keluar',$id)->sum('qty_out');

        	$updateStok = $stok+$qty;

        	DB::table('keluars')->where('id_keluar',$id)->delete();

        	DB::table('stoks')->where('id_stok','=',$id_stok)->update([
                'stok' => $updateStok,
                'updated_at' => \Carbon\Carbon::now('GMT+8')
            ]);
            toast('Data berhasil di dihapus','success');
            return redirect()->back();
        }
    }

// RIWAYAT-------------------------------------------------------------------
    public function Riwayat($home = null){
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            if ($home == "AA0101") {
                $title = "Stok Keluar Bisma Sentral";
                $dealer = "Bisma Sentral";
            }elseif ($home == "AA0102") {
                $title = "Stok Keluar Bisma Cokro";
                $dealer = "Bisma Cokro";
            }elseif ($home == "AA0104") {
                $title = "Stok Keluar Bisma Hasanuddin";
                $dealer = "Bisma Hasanuddin";
            }elseif ($home == "AA0105") {
                $title = "Stok Keluar Bisma TTS";
                $dealer = "Bisma TTS";
            }elseif ($home == "AA0106") {
                $title = "Stok Keluar Bisma Imam Bonjol";
                $dealer = "Bisma Imam Bonjol";
            }elseif ($home == "AA0107") {
                $title = "Stok Keluar Bisma Mandiri";
                $dealer = "Bisma Mandiri";
            }elseif ($home == "AA0108") {
                $title = "Stok Keluar Bisma WR Supratman";
                $dealer = "Bisma WR Supratman";
            }elseif ($home == "AA0109") {
                $title = "Stok Keluar Bisma Sunset Road";
                $dealer = "Bisma Sunset Road";
            }elseif ($home == "AA0104F") {
                $title = "Stok Keluar Flagship Shop";
                $dealer = "Flagship Shop";
            }else{
                $title = "Stok Keluar Error";
                $dealer = "Error";
            }

            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $tgl = DB::table('keluars')->where('dealer_kode',$home)->max('tanggal_keluar');
            $keluar = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->orderBy('tanggal_keluar','desc')
            ->where('keluars.dealer_kode',$home)->get();
            $total = DB::table('keluars')
            ->where([ ['dealer_kode',$home], ['tanggal_keluar',$tgl] ])
            ->sum('qty_out');
            $grandTotal = DB::table('keluars')
            ->where('dealer_kode',$home)
            ->sum('qty_out');

            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

            return view('out.riwayat',compact('title','dealer','keluar','now','total','tgl','grandTotal','home','data_user','count_user'));
        }
    }

    // DELETE RIWAYAT ===============================================================================
    public function Rdelete($id){
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            //Ambil ID Stok
            $id_stok = DB::table('keluars')->where('id_keluar',$id)->sum('stok_id');
            //Ambil Stok Terkini
            $stok = DB::table('stoks')->where('id_stok',$id_stok)->sum('stok');
            //Ambil Jumlah yang dihapus
            $qty = DB::table('keluars')->where('id_keluar',$id)->sum('qty_out');

            $updateStok = $stok+$qty;

            DB::table('keluars')->where('id_keluar',$id)->delete();

            DB::table('stoks')->where('id_stok','=',$id_stok)->update([
                'stok' => $updateStok,
                'updated_at' => \Carbon\Carbon::now('GMT+8')
            ]);
            toast('Data berhasil di dihapus','success');
            return redirect()->back();
        }
    }

}
