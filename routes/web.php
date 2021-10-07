<?php

use App\Http\Controllers\ManpowerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
* Route untuk segala proses LOGIN
*/
Route::get('/','LoginController@index');
Route::post('/login','LoginController@login');
Route::get('/logout','LoginController@Logout');

/**
* Route untuk segala informasi yang akan ditampilkan di Dashboard
*/
Route::prefix('inventory')->group(function(){
	Route::get('/','InventoryController@index');
	// Cari Unit
	Route::get('/cari','InventoryController@cariUnit');
});

/**
* Route untuk segala proses Data ADMIN
*/
Route::prefix('admin')->group(function(){
	Route::get('/','AdminController@index');
	Route::post('/update','AdminController@update');
	Route::post('/updatepass','AdminController@updatePass');
	Route::post('/store','AdminController@store');
	Route::get('/delete/{id}','AdminController@delete');
});

Route::get('/user', [UserController::class, 'index']);

/**
* Route untuk segala proses Data DEALER
*/
Route::prefix('dealer')->group(function(){
	Route::get('/','DealerController@index');
	Route::post('/store','DealerController@store');
	Route::post('/update','DealerController@update');
	Route::get('/delete/{id}','DealerController@delete');
	Route::get('/detail/{id}','DealerController@detail');
});

/**
* Route untuk segala proses Data MANPOWER
*/
Route::prefix('manpower')->group(function(){
	Route::get('/','ManpowerController@index');
	Route::post('/store','ManpowerController@store');
	Route::post('/update','ManpowerController@update');
	Route::get('/delete/{id}','ManpowerController@delete');
	Route::get('/detail/{id}','ManpowerController@detail');
});

/**
* Route untuk segala proses Data UNIT
*/
Route::prefix('unit')->group(function(){
	Route::get('/','UnitController@index');
	Route::post('/update','UnitController@update');
	Route::post('/store','UnitController@store');
	Route::post('/deleteall','UnitController@delete');
});

/**
* Route untuk segala proses Data LEASING
*/
Route::prefix('leasing')->group(function(){
	Route::get('/','LeasingController@index');
	Route::post('/update','LeasingController@update');
	Route::post('/store','LeasingController@store');
	Route::post('/deleteall','LeasingController@delete');
});

/**
* Route untuk segala proses Data FAKTUR DAN SERVICE
*/
Route::prefix('fands')->group(function(){
	Route::get('/{home?}','FSController@index');
	Route::post('update','FSController@update');
	Route::post('store','FSController@store');
	Route::post('deleteall','FSController@delete');
});

/**
* Route untuk segala proses Data WARNA
*/
Route::prefix('warna')->group(function(){
	Route::post('/update','WarnaController@update');
	Route::post('/store','WarnaController@store');
	Route::post('/deleteall','WarnaController@delete');
});

/**
* Route untuk segala proses Data STOK
*/
Route::prefix('stok')->group(function(){
	// READ--------------------------------------
	Route::get('/{home?}','StokController@stok');
	// -----------------------------------------

	// CREATE-----------------------------------------
	Route::post('/cstok','StokController@Cstok');
	// -----------------------------------------------

	// UPDATE-------------------------------------
	Route::post('/ustok','StokController@Ustok');
	// -------------------------------------------

	// DELETE ALL------------------------------------
	Route::post('/dstok','StokController@Dstok');
	// ----------------------------------------------
});

/**
* Route untuk segala proses Data STOK MASUK
*/
Route::prefix('in')->group(function(){
	// READ----------------------------------------------------
	Route::get('/masuk/{tgl?}/{home?}','InController@masuk');
	// --------------------------------------------------------

	//CREATE---------------------------------------------
	Route::post('/cmasuk','InController@Cmasuk');
	// --------------------------------------------------

	//DELETE----------------------------------------------
	Route::get('/dmasuk/{id}','InController@Delete');
	// ---------------------------------------------------

	//TAMBAH UNIT--------------------------------
	Route::post('/tunit','InController@Tunit');
	// ------------------------------------------

	//RIWAYAT---------------------------------------------
	Route::get('riwayat/{home?}','InController@Riwayat');
	// ---------------------------------------------------

	//DELETE RIWAYAT-------------------------------------------
	Route::get('/riwayat/delete/{id}','InController@Rdelete');
	// -------------------------------------------------------
});

/**
* Route untuk segala proses Data STOK KELUAR
*/
Route::prefix('out')->group(function(){
	// READ--------------------------------------------------
	Route::get('/keluar/{tgl?}/{home?}','OutController@keluar');
	// ------------------------------------------------------

	//CREATE-----------------------------------------
	Route::post('/ckeluar','OutController@Ckeluar');
	// ----------------------------------------------

	// DELETE-------------------------------------------
	Route::get('/dkeluar/{id}','OutController@Delete');
	// -------------------------------------------------

	// RIWAYAT---------------------------------------------
	Route::get('/riwayat/{home?}','OutController@Riwayat');
	// ----------------------------------------------------

	//DELETE RIWAYAT-------------------------------------------
	Route::get('/riwayat/delete/{id}','OutController@Rdelete');
	// --------------------------------------------------------
});

/**
* Route untuk segala proses Data STOK TERJUAL
*/
Route::prefix('sale')->group(function(){
	// READ---------------------------------------------------
	Route::get('/jual/{tgl?}/{home?}','SaleController@sale');
	// -------------------------------------------------------

	//CREATE--------------------------------------
	Route::post('/csale','SaleController@Csale');
	// -------------------------------------------

	//DELETE------------------------------------------
	Route::get('/dsale/{id}','SaleController@Destroy');
	// -----------------------------------------------

	//RIWAYAT-------------------------------------------------
	Route::get('/riwayat/{home?}','SaleController@Riwayat');
	// -------------------------------------------------------

	//DELETE RIWAYAT------------------------------------------------
	Route::get('/riwayat/delete/{id}','SaleController@Rdelete');
	// -------------------------------------------------------------
});

/**
* Route untuk segala proses Data STOK OPNAME
*/
Route::prefix('opname')->group(function(){
	// READ---------------------------------------------------
	Route::get('/stok/{tgl?}/{home?}','StokOpnameController@opname');
	// -------------------------------------------------------

	//CREATE--------------------------------------
	Route::post('/copname','StokOpnameController@Copname');
	// -------------------------------------------

	//DELETE------------------------------------------
	Route::post('/dopname','StokOpnameController@Destroy');
	// -----------------------------------------------

	//RIWAYAT-------------------------------------------------
	Route::get('/riwayat/{home?}','StokOpnameController@Riwayat');
	// -------------------------------------------------------
});

/**
* Route untuk proses LAPORAN
*/

Route::prefix('report')->group(function(){
	/**
	* Menampilkan Laporan Stok per Hari masing masing Dealer
	*/
	Route::get('/','ReportController@Laporan');
	Route::get('/cari','ReportController@cariLaporan');
	/*
	* Menampilkan Daftar Stok Unit By TAHUN
	*/
	Route::get('unit','ReportController@Unit');
	Route::get('unit/view/{tahun}','ReportController@viewUnit');
	/**
	* Export Daftar Unit Masing Masing Dealer
	*/
	//PDF-------------------------------------------------
	Route::get('stok/print/{home?}','ReportController@StokRpt');
	Route::get('unit/print/{tahun}','ReportController@printUnit');
	// EXCEL-------------------------------------------------------
	Route::get('stok/excel/{home?}','ReportController@StokExcel');
	Route::get('unit/excel/{tahun}','ReportController@excelUnit');

	/**
	* Menampilkan data penjualan Riil
	*/
	Route::get('riil','ReportController@Riil');
	Route::get('riilcari/','ReportController@RiilCari');
	/**
	* Export Penjualan Riil
	*/
	Route::get('riil/excel/{awal}/{akhir}','ReportController@excelPenjualan');
});

/**
* Route untuk cek tanggal update
*/

Route::post('/cek_update','InventoryController@CekUpdate');

/**
* Route untuk segala proses Data Lapor Stok
*/
Route::prefix('lapor')->group(function(){
	// HOME--------------------------------------
	Route::get('/','ReportController@home');
	// -----------------------------------------

	// READ--------------------------------------
	Route::get('/{home}','ReportController@lapor');
	// -----------------------------------------

	// RIWAYAT
	Route::get('/riwayat/{home}/{tgl}','ReportController@riwayat');

	// CREATE-----------------------------------------
	Route::post('/clapor','ReportController@Clapor');
	// -----------------------------------------------

	// EDIT--------------------------------------
	Route::get('/edit/{home}/{tgl}','ReportController@edit');
	// -----------------------------------------

	// DELETE------------------------------------
	Route::get('/dlapor/{home}/{tgl}','ReportController@Dlapor');
	// ----------------------------------------------
});