<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\User;
use Carbon;
use Hash;

class AdminController extends Controller
{
    public function index(){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	$title = "Data Admin";
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $data = User::all();
            
            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

    		return view('admin.data_admin',compact('title','data','now','data_user','count_user'));
        }
    }

    public function store(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	$cek = User::where('username',$req->user)->count();
        	if ($cek > 0) {
        		alert('Peringatan','Username sudah ada!','warning')->persistent('OK');
        		return redirect()->back();
        	}else{
        		$pass = $req->pass;
        		$confirm = $req->confirm;
        		if ($confirm == $pass) {
        			DB::table('users')->insert([
        				'name' => $req->nama,
        				'username' => $req->user,
        				'password' => Hash::make($pass),
        				'akses' => $req->akses,
                        'dealer' => $req->dealer,
                        'kode_dealer' => $req->kode,
        				'created_at' => \Carbon\Carbon::now('GMT+8'),
        			]);
        			toast('Data berhasil di tambah','success');
        			return redirect('admin/');
        		}else{
        			alert('Peringatan','Password tidak sama, Ulangi konfirmasi password!','warning')->persistent('OK');
        			return redirect()->back();
        		}
        	}
        }
    }

    public function update(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	DB::table('users')->where('id',$req->id)->update([
        		'name' => $req->nama,
        		'username' => $req->user,
                'dealer' => $req->dealer,
                'kode_dealer' => $req->kode,
        		'akses' => $req->akses,
        		'updated_at' => \Carbon\Carbon::now('GMT+8'),
        	]);
        	toast('Data berhasil di ubah','success');
        	return redirect('admin/');
        }
    }

    public function updatePass(Request $req){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	$passLama = $req->passLama;
            $passBaru = $req->passBaru;
            $confirm = $req->confirm;
            $cek = DB::table('users')->where('username',$req->user)->first();

            if (Hash::check($passLama,$cek->password)){
                if ($confirm == $passBaru) {
                        DB::table('users')->where('id',$req->id)->update([
                        'password' => Hash::make($confirm),
                    ]);
                    toast('Password berhasil di ubah','success');
                    return redirect('admin/');
                }else{
                    alert('Gagal Update!','Pastikan konfirmasi password sama!','warning')->persistent('OK');
                    return redirect()->back();
                }
            }else{
                alert('Oops..','Pastikan password Admin benar!','warning')->persistent('OK');
                return redirect()->back();
            }
        }
    }

    public function delete($id){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            DB::table('users')->where('id',$id)->delete();
            toast('Data admin berhasil di hapus','success');
            return redirect('admin/');
        }
    }
}
