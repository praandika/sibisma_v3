<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\StokOpname;
use App\Stok;
use App\Warna;
use App\Unit;
use DB;
use Carbon;

class StokOpnameController extends Controller
{
    public function opname($tgl = null, $home = null){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{

            if ($home == "AA0101") {
                $title = "Stok Opname Bisma Sentral";
                $dealer = "Bisma Sentral";
            }elseif ($home == "AA0102") {
                $title = "Stok Opname Bisma Cokro";
                $dealer = "Bisma Cokro";
            }elseif ($home == "AA0104") {
                $title = "Stok Opname Bisma Hasanuddin";
                $dealer = "Bisma Hasanuddin";
            }elseif ($home == "AA0105") {
                $title = "Stok Opname Bisma TTS";
                $dealer = "Bisma TTS";
            }elseif ($home == "AA0106") {
                $title = "Stok Opname Bisma Imam Bonjol";
                $dealer = "Bisma Imam Bonjol";
            }elseif ($home == "AA0107") {
                $title = "Stok Opname Bisma Mandiri";
                $dealer = "Bisma Mandiri";
            }elseif ($home == "AA0108") {
                $title = "Stok Opname Bisma WR Supratman";
                $dealer = "Bisma WR Supratman";
            }elseif ($home == "AA0109") {
                $title = "Stok Opname Bisma Sunset Road";
                $dealer = "Bisma Sunset Road";
            }elseif ($home == "AA0104F") {
                $title = "Stok Opname Flagship Shop";
                $dealer = "Flagship Shop";
            }else{
                $title = "Stok Opname Error";
                $dealer = "Error";
            }

        	$now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
        	$warna = Warna::orderBy('warna','asc')->get();
            $stok = Stok::where('dealer_kode',$home)->sum('stok');
        	$unit = Unit::orderBy('nama_unit','asc')->get();
        	$data = Stok::orderBy('nama_motor','asc')->where('dealer_kode',$home)->get();
        	$opname = DB::table('stok_opnames')
        	->join('stoks','stok_opnames.stok_id','=','stoks.id_stok')
        	->orderBy('tanggal_opname','desc')
            ->where([ ['stok_opnames.dealer_kode',$home], ['tanggal_opname',$tgl] ])->get();
            
            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

        	return view('opname.data',compact('title','dealer','data','opname','warna','now','unit','stok','home','data_user','count_user'));
        }
    }

// UPDATE=========================================================================
    public function Copname(Request $req){
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	$si = $req->stok_sistem;
        	$so = $req->stok_opname;

        	if ($si > $so) {
        		$selisih = $si - $so;
        	}elseif($so > $si){
        		$selisih = $so - $si;
        	}else{
        		$selisih = $si - $so;
        	}

            DB::table('stoks')->where('id_stok',$req->id_stok)->update([
                'stok' => $req->stok_opname,
                'updated_at' => \Carbon\Carbon::now('GMT+8'),
            ]);

            DB::table('stok_opnames')->insert([
            	'tanggal_opname' => $req->tanggal,
            	'dealer_kode' => $req->kode_dealer,
            	'stok_id' => $req->id_stok,
            	'stok_sistem' => $req->stok_sistem,
            	'stok_opname' => $req->stok_opname,
            	'selisih' => $selisih
            ]);

            $tgl = $req->tanggal;

            $home = $req->kode_dealer;

            $data = ['tanggal' => $tgl];

            toast('Stok Opname','success');
            return redirect('opname/stok/'.$tgl.'/'.$home.'')->with('input',$data)->withInput(
                    $req->except('unit','id_stok','jenis','tahun','warna','stok_sistem','stok_opname','tanggal'));
        }
    }

// DELETE STOK OPNAME
	public function Destroy(Request $req){
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            $delid = $req->input('pilih');
            DB::table('stok_opnames')->whereIn('id_opname',$delid)->delete();
            toast('Data berhasil di hapus','success');
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
                $title = "Stok Opname Bisma Sentral";
                $dealer = "Bisma Sentral";
            }elseif ($home == "AA0102") {
                $title = "Stok Opname Bisma Cokro";
                $dealer = "Bisma Cokro";
            }elseif ($home == "AA0104") {
                $title = "Stok Opname Bisma Hasanuddin";
                $dealer = "Bisma Hasanuddin";
            }elseif ($home == "AA0105") {
                $title = "Stok Opname Bisma TTS";
                $dealer = "Bisma TTS";
            }elseif ($home == "AA0106") {
                $title = "Stok Opname Bisma Imam Bonjol";
                $dealer = "Bisma Imam Bonjol";
            }elseif ($home == "AA0107") {
                $title = "Stok Opname Bisma Mandiri";
                $dealer = "Bisma Mandiri";
            }elseif ($home == "AA0108") {
                $title = "Stok Opname Bisma WR Supratman";
                $dealer = "Bisma WR Supratman";
            }elseif ($home == "AA0109") {
                $title = "Stok Opname Bisma Sunset Road";
                $dealer = "Bisma Sunset Road";
            }elseif ($home == "AA0104F") {
                $title = "Stok Opname Flagship Shop";
                $dealer = "Flagship Shop";
            }else{
                $title = "Stok Opname Error";
                $dealer = "Error";
            }

            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $tgl = DB::table('stok_opnames')->where('dealer_kode',$home)->max('tanggal_opname');
            $opname = DB::table('stok_opnames')
            ->join('stoks','stok_opnames.stok_id','=','stoks.id_stok')
            ->orderBy('tanggal_opname','desc')
            ->where('stok_opnames.dealer_kode',$home)->get();

            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

            return view('opname.riwayat',compact('title','dealer','opname','now','tgl','home','data_user','count_user'));
        }
    }
}
