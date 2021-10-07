<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use DB;
use Session;
use Hash;
use Carbon;

class LoginController extends Controller
{
    public function index(){
    	return view('index');
    }

    public function login(Request $request){
    	$user = $request->user;
    	$pass = $request->pass;

    	$cek = DB::table('users')->where('username',$user)->first();
    	if ($cek) {
    		if (Hash::check($pass,$cek->password)) {
                Session::put('name',$cek->name);
    			Session::put('user',$cek->username);
    			Session::put('akses',$cek->akses);
				Session::put('dealer',$cek->dealer);
				Session::put('id',$cek->id);
				Session::put('kode_dealer',$cek->kode_dealer);
				Session::put('login',TRUE);
				
				$login = \Carbon\Carbon::now('GMT+8')->format('Y-m-d H:i:s');
				DB::table('users')->where('id',$cek->id)->update([
					'login' => $login
				]);

    			toast('Selamat Datang '.$cek->name.'','success')->width('300px');
                return redirect('inventory');
    		}else{
    			alert('Login Gagal!','Username atau password salah', 'warning')->persistent('OK');
    			return redirect('/')->withInput();
    		}
    	}else{
    		alert('Login Gagal!','Username tidak terdaftar', 'warning')->persistent('OK');
    		return redirect('/');
    	}
    }

    public function logout(){
		$id = Session::get('id');

		$logout = \Carbon\Carbon::now('GMT+8')->format('Y-m-d H:i:s');
		DB::table('users')->where('id',$id)->update([
			'logout' => $logout
		]);

		Session::flush();
    	toast('Anda sudah logout','success')->width('300px');
    	return redirect('/');
    }

// REGISTER
    public function register(){
    	$title = "Register";
    	$user = DB::table('users')->get();
    	return view('register',compact('user','title'));
    }

    public function registerProses(Request $request){
    	$pass = $request->password;
    	$confirm = $request->confirm;
    	$user = $request->username;

    	$cek = DB::table('users')->where('username',$user)->first();

    	if ($cek) {
    		alert('Ada Masalah!','Username sudah ada!', 'error')->persistent('OK');
    		return redirect('/register');
    	}else{
    		if ($confirm == $pass) {
	    		DB::table('users')->insert([
	            'username' => $user,
	            'password' => Hash::make($pass),
	            'akses' => $request->akses
        		]);
        		toast('Username berhasil ditambah','success')->width('300px');
       			return redirect('/register');
    		}else{
    			alert('Ada Masalah!','Password tidak cocok!', 'error')->persistent('OK');
    			return redirect('/register');
    		}
    	}
    }

// HALAMAN EDIT DATA USER
    public function edit($id){
        $title = "Edit User";
        $user = DB::table('users')->where('id',$id)->get();
        return view('registerEdit',compact('user','title'));
    }

// UPDATE DATA USER
    public function update(Request $request){
    	$pass = $request->password;
    	$confirm = $request->confirm;
    	$user = $request->username;

        if (empty($pass) AND empty($confirm)) {
            DB::table('users')->where('id',$request->id)->update([
                'akses' => $request->akses
            ]);
            return redirect('/register');

        }elseif ($confirm == $pass) {
    		DB::table('users')->where('id',$request->id)->update([
	            'password' => $request->pass,
	            'akses' => $request->akses,
        	]);
        	return redirect('/register');

    	}else{
    		alert('Ada Masalah!','Password tidak cocok!', 'error')->persistent('OK');
    		return redirect('/register/edit/{id}');
    	}
    }

// DELETE DATA USER
    public function delete($id){
        DB::table('users')->where('id',$id)->delete();
        toast('User berhasil dihapus','success')->width('300px');
        return redirect('/register');
    }
}
