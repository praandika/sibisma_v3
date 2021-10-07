<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon;
use Session;

class ManpowerController extends Controller
{
    public function index($home = null){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            if ($home == "AA0101") {
                $title = "Manpower Bisma Sentral";
                $dealer = "Bisma Sentral";
            }elseif ($home == "AA0102") {
                $title = "Manpower Bisma Cokro";
                $dealer = "Bisma Cokro";
            }elseif ($home == "AA0104") {
                $title = "Manpower Bisma Hasanudin";
                $dealer = "Bisma Hasanuddin";
            }elseif ($home == "AA0105") {
                $title = "Manpower Bisma TTS";
                $dealer = "Bisma TTS";
            }elseif ($home == "AA0106") {
                $title = "Manpower Bisma Imam Bonjol";
                $dealer = "Bisma Imam Bonjol";
            }elseif ($home == "AA0107") {
                $title = "Manpower Bisma Mandiri";
                $dealer = "Bisma Mandiri";
            }elseif ($home == "AA0108") {
                $title = "Manpower Bisma WR Supratman";
                $dealer = "Bisma WR Supratman";
            }elseif ($home == "AA0109") {
                $title = "Manpower Bisma Sunset Road";
                $dealer = "Bisma Sunset Road";
            }elseif ($home == "AA0104F") {
                $title = "Manpower Flagship Shop";
                $dealer = "Flagship Shop";
            }else{
                $title = "Manpower Error";
                $dealer = "Error";
            }

        	$title = "Manpower";
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            
            
            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

            if ($home == null) {
                $data = DB::table('manpower')
                ->join('dealers','dealers.kode_dealer','=','manpower.kode_dealer')
                ->orderBy('manpower.kode_dealer','asc')
                ->orderBy('manpower.nama_manpower','asc')->get();

                return view('manpower.data_manpower',compact('title','data','now','data_user','count_user','home'));
            }else{
                $data = DB::table('manpower')
                ->join('dealers','dealers.kode_dealer','=','manpower.kode_dealer')
                ->where('manpower.kode_dealer','=',$home)
                ->orderBy('manpower.nama_manpower','asc')->get();

                return view('manpower.data_manpower',compact('title','data','now','data_user','count_user','home'));
            }

	    	
        }	
    }

    public function store(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	$this->validate($req, [
            'foto' => 'required|file|image|mimes:jpeg,png,jpg',
            ]);

            $file = $req->file('foto');
            $nama_file = time()."_".$file->getClientOriginalName();

            $folder = 'profil';
            $file->move($folder,$nama_file);

        	DB::table('manpower')->insert([
        		'nama_manpower' => $req->nama,
        		'jabatan' => $req->jabatan,
        		'kontak' => $req->kontak,
        		'tanggal_lahir' => $req->tgl_lahir,
        		'tanggal_join' => $req->tgl_join,
        		'status_manpower' => $req->status,
        		'alamat' => $req->alamat,
                'kode_dealer' => $req->kode_dealer,
                'foto' => $req->nama_file,
                'created_at' => \Carbon\Carbon::now('GMT+8'),
        	]);
        	toast('Data berhasil di tambah','success');
        	return redirect('manpower');
        }
    }

    public function update(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	if ($req->check == true) {
                unlink('profil/'.$req->fotoLama);

                $this->validate($req, [
                'foto' => 'required|file|image|mimes:jpeg,png,jpg',
                ]);

                $file = $req->file('foto');
                $nama_file = time()."_".$file->getClientOriginalName();

                $folder = 'profil';
                $file->move($folder,$nama_file);

                DB::table('manpower')->where('id_manpower',$req->id)->update([
                    'nama_manpower' => $req->nama,
                    'jabatan' => $req->jabatan,
                    'kontak' => $req->kontak,
                    'tanggal_lahir' => $req->tgl_lahir,
                    'tanggal_join' => $req->tgl_join,
                    'status_manpower' => $req->status,
                    'alamat' => $req->alamat,
                    'kode_dealer' => $req->kode_dealer,
                    'foto' => $req->nama_file,
                    'updated_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                toast('Data berhasil di ubah','success');
        		return redirect('manpower/');
            }else{
                DB::table('manpower')->where('id_manpower',$req->id)->update([
                    'nama_manpower' => $req->nama,
                    'jabatan' => $req->jabatan,
                    'kontak' => $req->kontak,
                    'tanggal_lahir' => $req->tgl_lahir,
                    'tanggal_join' => $req->tgl_join,
                    'status_manpower' => $req->status,
                    'alamat' => $req->alamat,
                    'kode_dealer' => $req->kode_dealer,
                    'updated_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                toast('Data berhasil di ubah','success');
        		return redirect('manpower/');
            }
        }
    }

    public function delete($id){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            DB::table('manpower')->where('id_manpower',$id)->delete();
            toast('Data berhasil di hapus','success');
            return redirect('manpower/');
        }
    }
}
