<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Jual;
use App\Stok;
use App\Warna;
use App\Unit;
use App\Leasing;
use DB;
use Carbon;

class SaleController extends Controller
{
    public function sale($tgl = null, $home = null){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{

            if ($home == "AA0101") {
                $title = "Stok Terjual Bisma Sentral";
                $dealer = "Bisma Sentral";
            }elseif ($home == "AA0102") {
                $title = "Stok Terjual Bisma Cokro";
                $dealer = "Bisma Cokro";
            }elseif ($home == "AA0104") {
                $title = "Stok Terjual Bisma Hasanuddin";
                $dealer = "Bisma Hasanuddin";
            }elseif ($home == "AA0105") {
                $title = "Stok Terjual Bisma TTS";
                $dealer = "Bisma TTS";
            }elseif ($home == "AA0106") {
                $title = "Stok Terjual Bisma Imam Bonjol";
                $dealer = "Bisma Imam Bonjol";
            }elseif ($home == "AA0107") {
                $title = "Stok Terjual Bisma Mandiri";
                $dealer = "Bisma Mandiri";
            }elseif ($home == "AA0108") {
                $title = "Stok Terjual Bisma WR Supratman";
                $dealer = "Bisma WR Supratman";
            }elseif ($home == "AA0109") {
                $title = "Stok Terjual Bisma Sunset Road";
                $dealer = "Bisma Sunset Road";
            }elseif ($home == "AA0104F") {
                $title = "Stok Terjual Flagship Shop";
                $dealer = "Flagship Shop";
            }else{
                $title = "Stok Terjual Error";
                $dealer = "Error";
            }

        	$now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
        	$warna = Warna::orderBy('warna','asc')->get();
            $stok = Stok::where('dealer_kode',$home)->sum('stok');
        	$unit = Unit::orderBy('nama_unit','asc')->get();
        	$data = Stok::orderBy('nama_motor','asc')->where('dealer_kode',$home)->get();
            $leasing = Leasing::orderBy('nama_leasing','asc')->get();
        	$jual = DB::table('juals')
        	->join('stoks','juals.stok_id','=','stoks.id_stok')
        	->orderBy('tanggal_jual','desc')
        	->where([ ['juals.dealer_kode',$home], ['tanggal_jual',$tgl] ])->get();
        	$total = DB::table('juals')
        	->where([ ['dealer_kode',$home], ['tanggal_jual',$tgl] ])
            ->sum('qty');
            
            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

        	return view('sale.jual',compact('title','dealer','data','jual','warna','now','total','tgl','unit','stok','home','leasing','data_user','count_user'));
        }
    }

// CREATE ===============================================================
    public function Csale(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	$qty = DB::table('stoks')
	        ->where('id_stok',$req->id_stok)
	        ->sum('stok');

	        $sale = $req->qty;
	        $stok = $qty-$sale;

	        if ($sale > $qty) {
	        	alert('Stok Tidak Cukup!','Peringatan!', 'warning')->persistent('OK');
	        	return redirect()->back()->with('autofocus', true)->withInput();
	        }else{
                $leas = $req->leasing;
                $leasing2 = array();
                foreach ($leas as $leasing) {
                    array_push($leasing2, $leasing);
                }

                $leasing = serialize($leasing2);

	        	DB::table('juals')->insert([
		            'stok_id' => $req->id_stok,
		            'tanggal_jual' => $req->tanggal,
		            'qty' => $req->qty,
		            'dealer_kode' => $req->kode_dealer,
                    'leasing' => $leasing,
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
		        return redirect('sale/jual/'.$tgl.'/'.$home.'')->with('input',$data)->withInput(
                    $req->except('unit','id_stok','jenis','tahun','warna','stok','qty','tanggal'));
	        }
        }
    }

// DELETE ===============================================================================
    public function Destroy($id){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	//Ambil ID Stok
        	$id_stok = DB::table('juals')->where('id_jual',$id)->sum('stok_id');
        	//Ambil Stok Terkini
        	$stok = DB::table('stoks')->where('id_stok',$id_stok)->sum('stok');
        	//Ambil Jumlah yang dihapus
        	$qty = DB::table('juals')->where('id_jual',$id)->sum('qty');

        	$updateStok = $stok+$qty;

        	DB::table('juals')->where('id_jual',$id)->delete();

        	DB::table('stoks')->where('id_stok','=',$id_stok)->update([
                'stok' => $updateStok,
                'updated_at' => \Carbon\Carbon::now('GMT+8')
            ]);
            toast('Data berhasil di dihapus','success');
            return redirect()->back();
        }
    }

// RIWAYAT ===========================================================================
    public function Riwayat($home = null){
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            if ($home == "AA0101") {
                $title = "Stok Terjual Bisma Sentral";
                $dealer = "Bisma Sentral";
            }elseif ($home == "AA0102") {
                $title = "Stok Terjual Bisma Cokro";
                $dealer = "Bisma Cokro";
            }elseif ($home == "AA0104") {
                $title = "Stok Terjual Bisma Hasanuddin";
                $dealer = "Bisma Hasanuddin";
            }elseif ($home == "AA0105") {
                $title = "Stok Terjual Bisma TTS";
                $dealer = "Bisma TTS";
            }elseif ($home == "AA0106") {
                $title = "Stok Terjual Bisma Imam Bonjol";
                $dealer = "Bisma Imam Bonjol";
            }elseif ($home == "AA0107") {
                $title = "Stok Terjual Bisma Mandiri";
                $dealer = "Bisma Mandiri";
            }elseif ($home == "AA0108") {
                $title = "Stok Terjual Bisma WR Supratman";
                $dealer = "Bisma WR Supratman";
            }elseif ($home == "AA0109") {
                $title = "Stok Terjual Bisma Sunset Road";
                $dealer = "Bisma Sunset Road";
            }elseif ($home == "AA0104F") {
                $title = "Stok Terjual Flagship Shop";
                $dealer = "Flagship Shop";
            }else{
                $title = "Stok Terjual Error";
                $dealer = "Error";
            }

            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $tgl = DB::table('juals')->where('dealer_kode',$home)->max('tanggal_jual');
            $jual = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->orderBy('tanggal_jual','desc')
            ->where('juals.dealer_kode',$home)->get();
            $total = DB::table('juals')
            ->where([ ['dealer_kode',$home], ['tanggal_jual',$tgl] ])
            ->sum('qty');
            $grandTotal = DB::table('juals')
            ->where('dealer_kode',$home)
            ->sum('qty');

            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

            return view('sale.riwayat',compact('title','dealer','jual','now','total','tgl','grandTotal','home','data_user','count_user'));
        }
    }

// DELETE RIWAYAT ===============================================================================
    public function Rdelete($id){
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            //Ambil ID Stok
            $id_stok = DB::table('juals')->where('id_jual',$id)->sum('stok_id');
            //Ambil Stok Terkini
            $stok = DB::table('stoks')->where('id_stok',$id_stok)->sum('stok');
            //Ambil Jumlah yang dihapus
            $qty = DB::table('juals')->where('id_jual',$id)->sum('qty');

            $updateStok = $stok+$qty;

            DB::table('juals')->where('id_jual',$id)->delete();

            DB::table('stoks')->where('id_stok','=',$id_stok)->update([
                'stok' => $updateStok,
                'updated_at' => \Carbon\Carbon::now('GMT+8')
            ]);
            toast('Data berhasil di dihapus','success');
            return redirect()->back();
        }
    }
}
