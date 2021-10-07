<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use App\Masuk;
use App\Stok;
use App\Warna;
use App\Unit;
use DB;
use Carbon;

class InController extends Controller
{
    // LANJUT... LOGIKA : if $home == "AA0101"
    public function masuk($tgl = null, $home = null){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{

            if ($home == "AA0101") {
                $title = "Stok Masuk Bisma Sentral";
                $dealer = "Bisma Sentral";
            }elseif ($home == "AA0102") {
                $title = "Stok Masuk Bisma Cokro";
                $dealer = "Bisma Cokro";
            }elseif ($home == "AA0104") {
                $title = "Stok Masuk Bisma Hasanuddin";
                $dealer = "Bisma Hasanuddin";
            }elseif ($home == "AA0105") {
                $title = "Stok Masuk Bisma TTS";
                $dealer = "Bisma TTS";
            }elseif ($home == "AA0106") {
                $title = "Stok Masuk Bisma Imam Bonjol";
                $dealer = "Bisma Imam Bonjol";
            }elseif ($home == "AA0107") {
                $title = "Stok Masuk Bisma Mandiri";
                $dealer = "Bisma Mandiri";
            }elseif ($home == "AA0108") {
                $title = "Stok Masuk Bisma WR Supratman";
                $dealer = "Bisma WR Supratman";
            }elseif ($home == "AA0109") {
                $title = "Stok Masuk Bisma Sunset Road";
                $dealer = "Bisma Sunset Road";
            }elseif ($home == "AA0104F") {
                $title = "Stok Masuk Flagship Shop";
                $dealer = "Flagship Shop";
            }else{
                $title = "Stok Masuk Error";
                $dealer = "Error";
            }
        	
        	$now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
        	$warna = Warna::orderBy('warna','asc')->get();
            $stok = Stok::where('dealer_kode',$home)->sum('stok');
        	$unit = Unit::orderBy('nama_unit','asc')->get();
        	$data = Stok::orderBy('nama_motor','asc')->where('dealer_kode',$home)->get();
        	$masuk = DB::table('masuks')
        	->join('stoks','masuks.stok_id','=','stoks.id_stok')
        	->orderBy('tanggal_masuk','desc')
        	->where([ ['masuks.dealer_kode',$home], ['tanggal_masuk',$tgl] ])->get();
        	$total = DB::table('masuks')
        	->where([ ['dealer_kode',$home], ['tanggal_masuk',$tgl] ])
            ->sum('qty_in');
            
            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

        	return view('in.masuk',compact('title','dealer','data','masuk','warna','now','total','tgl','unit','stok','home','data_user','count_user'));
        }
    }

 // CREATE==========================================================================================
    public function Cmasuk(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	if ($req->pemasok == "") {
        		alert('Pilih Pemasok!','Data tidak lengkap!', 'warning')->persistent('OK');
	            return redirect()->back()->with('auto', true)->withInput();
        	}else{
        		$qty = DB::table('stoks')
	        	->where('id_stok',$req->id_stok)
	        	->sum('stok');

	        	$msk = $req->qty;
	        	$stok = $qty+$msk;

	        	DB::table('masuks')->insert([
	                'stok_id' => $req->id_stok,
	                'tanggal_masuk' => $req->tanggal,
	                'qty_in' => $req->qty,
	                'pemasok' => $req->pemasok,
	                'dealer_kode' => $req->kode_dealer,
	                'created_at' => \Carbon\Carbon::now('GMT+8')
	            ]);

                //Update Tabel Stok
	            DB::table('stoks')->where('id_stok',$req->id_stok)->update([
	                'stok' => $stok,
	                'updated_at' => \Carbon\Carbon::now('GMT+8')
	            ]);

                $tgl = $req->tanggal;

                $home = $req->kode_dealer;

                $data = [
                    'tanggal' => $tgl,
                ];

	            toast('Data berhasil di tambah','success');
	            return redirect('in/masuk/'.$tgl.'/'.$home.'')->with('input',$data)->withInput(
                    $req->except('unit','id_stok','jenis','tahun','warna','stok','qty','tanggal')
                );
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
        	$id_stok = DB::table('masuks')->where('id_masuk',$id)->sum('stok_id');
        	//Ambil Stok Terkini
        	$stok = DB::table('stoks')->where('id_stok',$id_stok)->sum('stok');
        	//Ambil Jumlah yang dihapus
        	$qty = DB::table('masuks')->where('id_masuk',$id)->sum('qty_in');

        	$updateStok = $stok-$qty;

        	DB::table('masuks')->where('id_masuk',$id)->delete();

        	DB::table('stoks')->where('id_stok','=',$id_stok)->update([
                'stok' => $updateStok,
                'updated_at' => \Carbon\Carbon::now('GMT+8')
            ]);
            toast('Data berhasil di dihapus','success');
            return redirect()->back();
        }
    }

    // TAMBAH UNIT ===============================================================================
    public function Tunit(Request $req){
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            if ($req->gambar == "") {
                DB::table('stoks')->insert([
                    'unit_id' => $req->id_unit,
                    'nama_motor' => $req->nama,
                    'warna' => $req->warna,
                    'jenis' => $req->jenis,
                    'stok' => 0,
                    'tahun' => $req->tahun,
                    'dealer_kode' => $req->kode_dealer,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                toast('Data berhasil di tambah','success');
                return redirect()->back();
            }else{
                $this->validate($req, [
                'gambar' => 'required|file|image|mimes:jpeg,png,jpg',
                ]);

                $file = $req->file('gambar');
                $nama_file = time()."_".$file->getClientOriginalName();

                $folder = 'img';
                $file->move($folder,$nama_file);

                DB::table('stoks')->insert([
                    'unit_id' => $req->id_unit,
                    'nama_motor' => $req->nama,
                    'warna' => $req->warna,
                    'jenis' => $req->jenis,
                    'stok' => 0,
                    'tahun' => $req->tahun,
                    'dealer_kode' => $req->kode_dealer,
                    'gambar' => $nama_file,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                toast('Data berhasil di tambah','success');
                return redirect()->back();
            }
        }
    }

    // RIWAYAT ========================================================================
    public function Riwayat($home = null){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	if ($home == "AA0101") {
                $title = "Stok Masuk Bisma Sentral";
                $dealer = "Bisma Sentral";
            }elseif ($home == "AA0102") {
                $title = "Stok Masuk Bisma Cokro";
                $dealer = "Bisma Cokro";
            }elseif ($home == "AA0104") {
                $title = "Stok Masuk Bisma Hasanuddin";
                $dealer = "Bisma Hasanuddin";
            }elseif ($home == "AA0105") {
                $title = "Stok Masuk Bisma TTS";
                $dealer = "Bisma TTS";
            }elseif ($home == "AA0106") {
                $title = "Stok Masuk Bisma Imam Bonjol";
                $dealer = "Bisma Imam Bonjol";
            }elseif ($home == "AA0107") {
                $title = "Stok Masuk Bisma Mandiri";
                $dealer = "Bisma Mandiri";
            }elseif ($home == "AA0108") {
                $title = "Stok Masuk Bisma WR Supratman";
                $dealer = "Bisma WR Supratman";
            }elseif ($home == "AA0109") {
                $title = "Stok Masuk Bisma Sunset Road";
                $dealer = "Bisma Sunset Road";
            }elseif ($home == "AA0104F") {
                $title = "Stok Masuk Flagship Shop";
                $dealer = "Flagship Shop";
            }else{
                $title = "Stok Masuk Error";
                $dealer = "Error";
            }

        	$now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
        	$tgl = DB::table('masuks')->where('dealer_kode',$home)->max('tanggal_masuk');
        	$masuk = DB::table('masuks')
        	->join('stoks','masuks.stok_id','=','stoks.id_stok')
        	->orderBy('tanggal_masuk','desc')
        	->where('masuks.dealer_kode',$home)->get();
        	$total = DB::table('masuks')
        	->where([ ['dealer_kode',$home], ['tanggal_masuk',$tgl] ])
        	->sum('qty_in');
        	$grandTotal = DB::table('masuks')
        	->where('dealer_kode',$home)
            ->sum('qty_in');
            
            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

        	return view('in.riwayat',compact('title','dealer','masuk','now','total','tgl','grandTotal','home','data_user','count_user'));
        }
    }

// DELETE RIWAYAT ===============================================================================
    public function Rdelete($id){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	//Ambil ID Stok
        	$id_stok = DB::table('masuks')->where('id_masuk',$id)->sum('stok_id');
        	//Ambil Stok Terkini
        	$stok = DB::table('stoks')->where('id_stok',$id_stok)->sum('stok');
        	//Ambil Jumlah yang dihapus
        	$qty = DB::table('masuks')->where('id_masuk',$id)->sum('qty_in');

        	$updateStok = $stok-$qty;

        	DB::table('masuks')->where('id_masuk',$id)->delete();

        	DB::table('stoks')->where('id_stok','=',$id_stok)->update([
                'stok' => $updateStok,
                'updated_at' => \Carbon\Carbon::now('GMT+8')
            ]);
            toast('Data berhasil di dihapus','success');
            return redirect()->back();
        }
    }
}
