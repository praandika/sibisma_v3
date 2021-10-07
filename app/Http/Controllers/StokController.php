<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Stok;
use App\Masuk;
use App\Unit;
use App\Warna;
use DB;
use Carbon;

class StokController extends Controller
{
    // READ=========================================================================
    public function stok($home = null){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	if ($home == "AA0101") {
                $title = "Stok Bisma Sentral";
                $dealer = "Bisma Sentral";
            }elseif ($home == "AA0102") {
                $title = "Stok Bisma Cokro";
                $dealer = "Bisma Cokro";
            }elseif ($home == "AA0104") {
                $title = "Stok Bisma Hasanuddin";
                $dealer = "Bisma Hasanuddin";
            }elseif ($home == "AA0105") {
                $title = "Stok Bisma TTS";
                $dealer = "Bisma TTS";
            }elseif ($home == "AA0106") {
                $title = "Stok Bisma Imam Bonjol";
                $dealer = "Bisma Imam Bonjol";
            }elseif ($home == "AA0107") {
                $title = "Stok Bisma Mandiri";
                $dealer = "Bisma Mandiri";
            }elseif ($home == "AA0108") {
                $title = "Stok Bisma WR Supratman";
                $dealer = "Bisma WR Supratman";
            }elseif ($home == "AA0109") {
                $title = "Stok Bisma Sunset Road";
                $dealer = "Bisma Sunset Road";
            }elseif ($home == "AA0104F") {
                $title = "Stok Flagship Shop";
                $dealer = "Flagship Shop";
            }else{
                $title = "Stok Error";
                $dealer = "Error";
            }

            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $data = DB::table('stoks')
            ->join('dealers','stoks.dealer_kode','=','dealers.kode_dealer')
            ->where('dealer_kode',$home)
            ->orderBy('nama_motor','asc')
            ->get();
            $unit = Unit::orderBy('nama_unit','asc')->get();
            $warna = Warna::orderBy('warna','asc')->get();
            $stok = DB::table('stoks')
            ->where('dealer_kode',$home)
            ->sum('stok');

            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

            return view('stok.data',compact('title','data','unit','warna','stok','home','now','data_user','count_user'));
        }
    }

    
    // CREATE=========================================================================
    public function Cstok(Request $req){
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
                    'stok' => $req->stok,
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
                    'stok' => $req->stok,
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

    // UPDATE=========================================================================
    public function Ustok(Request $req){
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            if ($req->check == true) {
                if ($req->gambarLama == "") {
                    $this->validate($req, [
                    'gambar' => 'required|file|image|mimes:jpeg,png,jpg',
                    ]);

                    $file = $req->file('gambar');
                    $nama_file = time()."_".$file->getClientOriginalName();

                    $folder = 'img';
                    $file->move($folder,$nama_file);

                    DB::table('stoks')->where('id_stok',$req->id)->update([
                        'nama_motor' => $req->nama,
                        'warna' => $req->warna,
                        'jenis' => $req->jenis,
                        'stok' => $req->stok,
                        'tahun' => $req->tahun,
                        'dealer_kode' => $req->kode_dealer,
                        'gambar' => $nama_file,
                        'updated_at' => \Carbon\Carbon::now('GMT+8'),
                    ]);
                    toast('Data berhasil di tambah','success');
                    return redirect('stok/sentral');
                }else{
                    unlink('img/'.$req->gambarLama);

                    $this->validate($req, [
                    'gambar' => 'required|file|image|mimes:jpeg,png,jpg',
                    ]);

                    $file = $req->file('gambar');
                    $nama_file = time()."_".$file->getClientOriginalName();

                    $folder = 'img';
                    $file->move($folder,$nama_file);

                    DB::table('stoks')->where('id_stok',$req->id)->update([
                        'nama_motor' => $req->nama,
                        'warna' => $req->warna,
                        'jenis' => $req->jenis,
                        'stok' => $req->stok,
                        'tahun' => $req->tahun,
                        'dealer_kode' => $req->kode_dealer,
                        'gambar' => $nama_file,
                        'updated_at' => \Carbon\Carbon::now('GMT+8'),
                    ]);
                    toast('Data berhasil di tambah','success');
                    return redirect('stok/sentral');
                }
            }else{
                DB::table('stoks')->where('id_stok',$req->id)->update([
                    'nama_motor' => $req->nama,
                    'warna' => $req->warna,
                    'jenis' => $req->jenis,
                    'stok' => $req->stok,
                    'tahun' => $req->tahun,
                    'dealer_kode' => $req->kode_dealer,
                    'updated_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                toast('Data berhasil di tambah','success');
                return redirect()->back();
            }
        }
    }


    // DELETE ALL=========================================================================
    public function Dstok(Request $req){ 
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            $delid = $req->input('pilih');
            DB::table('stoks')->whereIn('id_stok',$delid)->delete();
            toast('Data berhasil di hapus','success');
            return redirect()->back();
        }
    }
}
