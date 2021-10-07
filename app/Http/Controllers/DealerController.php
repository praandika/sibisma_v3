<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dealer;
use DB;
use Carbon;
use Session;

class DealerController extends Controller
{
    public function index(){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	$title = "Dealer";
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $data = Dealer::orderBy('kode_dealer','asc')->get();
            
            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

	    	return view('dealer.data_dealer',compact('title','data','now','data_user','count_user'));
        }	
    }

    public function store(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	$this->validate($req, [
            'qrcode' => 'required|file|image|mimes:jpeg,png,jpg',
            ]);

            $file = $req->file('qrcode');
            $nama_file = time()."_".$file->getClientOriginalName();

            $folder = 'qr';
            $file->move($folder,$nama_file);

        	DB::table('dealers')->insert([
        		'kode_dealer' => $req->kode,
        		'nama_dealer' => $req->nama,
        		'alamat' => $req->alamat,
        		'telp' => $req->telp,
        		'koordinat' => $req->koordinat,
        		'qrcode' => $nama_file,
        		'created_at' => \Carbon\Carbon::now('GMT+8'),
        	]);
        	toast('Data berhasil di tambah','success');
        	return redirect('dealer');
        }
    }

    public function update(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	if ($req->check == true) {
                unlink('img/'.$req->qrLama);

                $this->validate($req, [
                'qrcode' => 'required|file|image|mimes:jpeg,png,jpg',
                ]);

                $file = $req->file('qrcode');
                $nama_file = time()."_".$file->getClientOriginalName();

                $folder = 'img';
                $file->move($folder,$nama_file);

                DB::table('dealers')->where('id_dealer',$req->id)->update([
                    'kode_dealer' => $req->kode,
	        		'nama_dealer' => $req->nama,
	        		'alamat' => $req->alamat,
	        		'telp' => $req->telp,
	        		'koordinat' => $req->koordinat,
	        		'qrcode' => $nama_file,
	        		'updated_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                toast('Data berhasil di ubah','success');
        		return redirect('dealer/');
            }else{
                DB::table('dealers')->where('id_dealer',$req->id)->update([
                    'kode_dealer' => $req->kode,
	        		'nama_dealer' => $req->nama,
	        		'alamat' => $req->alamat,
	        		'telp' => $req->telp,
	        		'koordinat' => $req->koordinat,
	        		'updated_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                toast('Data berhasil di ubah','success');
        		return redirect('dealer/');
            }
        }
    }

    public function delete($id){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            DB::table('dealers')->where('id_dealer',$id)->delete();
            toast('Data berhasil di hapus','success');
            return redirect('dealer/');
        }
    }
}
