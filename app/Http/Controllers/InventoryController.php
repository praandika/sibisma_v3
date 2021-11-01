<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Charts\ChartJs;
use App\Charts\MinimalistChartJs;
use Carbon;

class InventoryController extends Controller
{
    public function index(){
    	if (!Session::get('login')) {
    		alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
    		return redirect('/');
    	}else{
            $kode_dealer = Session::get('kode_dealer');

            if ($kode_dealer == "AA0101") {
                $nama_dealer = "Bisma Sentral";
            } elseif($kode_dealer == "AA0102") {
                $nama_dealer = "Bisma Cokro";
            }elseif($kode_dealer == "AA0104") {
                $nama_dealer = "Bisma Hasanudin";
            }elseif($kode_dealer == "AA0105") {
                $nama_dealer = "Bisma TTS";
            }elseif($kode_dealer == "AA0106") {
                $nama_dealer = "Bisma Imbo";
            }elseif($kode_dealer == "AA0107") {
                $nama_dealer = "Bisma Mandiri";
            }elseif($kode_dealer == "AA0108") {
                $nama_dealer = "Bisma Supratman";
            }elseif($kode_dealer == "AA0109") {
                $nama_dealer = "Bisma Sunset Road";
            }elseif($kode_dealer == "AA0104F") {
                $nama_dealer = "Flagship Shop";
            }elseif($kode_dealer == "group") {
                $nama_dealer = "Bisma Group";
            }else{
                $nama_dealer = "Tidak ada Session";
            }
            
    		$title = "Dashboard";
    		$now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $tahun = \Carbon\Carbon::now('GMT+8')->format('Y');
            $bulan = \Carbon\Carbon::now('GMT+8')->format('m');
            $bln = \Carbon\Carbon::now('GMT+8')->format('F');
            $hari = \Carbon\Carbon::now('GMT+8')->format('d');
            $LY = $tahun - 1;

            // Variable untuk menjumlahkan Total Jual Group
            $total = 0;

            // Ambil Tanggal Update Stok dari database
            $tgl_update = DB::table('info_tgl_update')
            ->get();

            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

            // Cek session dealer
            if (empty($kode_dealer)) {
                alert('Warning!','Anda tidak memiliki akses!', 'warning')->persistent('OK');
    		    return redirect('/');
            
            // IF GROUP
            }elseif($kode_dealer == "group"){

                // Unit Terjual TAHUN
                $yearSale = DB::table('juals')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                // Unit Terjual BULAN
                $monthSale = DB::table('juals')
                ->whereYear('tanggal_jual',$tahun)
                ->whereMonth('tanggal_jual',$bulan)
                ->sum('qty');

                // Unit Terjual HARI
                $daySale = DB::table('juals')
                ->whereYear('tanggal_jual',$tahun)
                ->whereMonth('tanggal_jual',$bulan)
                ->whereDay('tanggal_jual',$hari)
                ->sum('qty');

                //Detail Unit Terjual TAHUN
                $yearSaleDetail = DB::table('juals')
                ->join('dealers','juals.dealer_kode','=','dealers.kode_dealer')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_dealer')
                ->whereYear('tanggal_jual',$tahun)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_dealer')
                ->get();

                //Detail Unit Terjual BULAN
                $monthSaleDetail = DB::table('juals')
                ->whereYear('tanggal_jual',$tahun)
                ->whereMonth('tanggal_jual',$bulan)
                ->get();

                //Detail Unit Terjual HARI
                $daySaleDetail = DB::table('juals')
                ->whereYear('tanggal_jual',$tahun)
                ->whereMonth('tanggal_jual',$bulan)
                ->whereDay('tanggal_jual',$hari)
                ->get();

                /** =================================================*/
                /*                   Chart penjualan                 */
                /* ==================================================*/
                $jan = DB::table('juals')
                ->whereMonth('tanggal_jual','01')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $feb = DB::table('juals')
                ->whereMonth('tanggal_jual','02')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $mar = DB::table('juals')
                ->whereMonth('tanggal_jual','03')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $apr = DB::table('juals')
                ->whereMonth('tanggal_jual','04')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $may = DB::table('juals')
                ->whereMonth('tanggal_jual','05')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $jun = DB::table('juals')
                ->whereMonth('tanggal_jual','06')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $jul = DB::table('juals')
                ->whereMonth('tanggal_jual','07')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $aug = DB::table('juals')
                ->whereMonth('tanggal_jual','08')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $sep = DB::table('juals')
                ->whereMonth('tanggal_jual','09')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $oct = DB::table('juals')
                ->whereMonth('tanggal_jual','10')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $nov = DB::table('juals')
                ->whereMonth('tanggal_jual','11')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $dec = DB::table('juals')
                ->whereMonth('tanggal_jual','12')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                //LAST YEAR 

                $janLY = DB::table('juals')
                ->whereMonth('tanggal_jual','01')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $febLY = DB::table('juals')
                ->whereMonth('tanggal_jual','02')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $marLY = DB::table('juals')
                ->whereMonth('tanggal_jual','03')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $aprLY = DB::table('juals')
                ->whereMonth('tanggal_jual','04')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $mayLY = DB::table('juals')
                ->whereMonth('tanggal_jual','05')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $junLY = DB::table('juals')
                ->whereMonth('tanggal_jual','06')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $julLY = DB::table('juals')
                ->whereMonth('tanggal_jual','07')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $augLY = DB::table('juals')
                ->whereMonth('tanggal_jual','08')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $sepLY = DB::table('juals')
                ->whereMonth('tanggal_jual','09')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $octLY = DB::table('juals')
                ->whereMonth('tanggal_jual','10')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $novLY = DB::table('juals')
                ->whereMonth('tanggal_jual','11')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $decLY = DB::table('juals')
                ->whereMonth('tanggal_jual','12')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $chartJual = new ChartJs;
                $chartJual->title('Penjualan Unit Bisma Group By Months');
                $chartJual->displaylegend(true);
                $chartJual->labels([
                    'Jan','Feb','Mar','Apr','May','Jun',
                    'Jul','Aug','Sep','Oct','Nov','Des'
                ]);

                $chartJual->dataset($tahun, 'line', [
                    $jan, $feb, $mar, $apr, $may, $jun,
                    $jul, $aug, $sep, $oct, $nov, $dec
                ])
                ->color("#233699")
                ->backgroundcolor("rgba(17,55,192,0.4)")
                ->linetension(0.0);

                $chartJual->dataset($LY, 'line', [
                    $janLY, $febLY, $marLY, $aprLY, $mayLY, $junLY,
                    $julLY, $augLY, $sepLY, $octLY, $novLY, $decLY
                ])
                ->color("#EB9D22")
                ->backgroundcolor("rgba(231,180,24,0.4)")
                ->linetension(0.0);
                /** =================================================*/
                /*                 END Chart penjualan               */
                /* ==================================================*/

                /** =================================================*/
                /*                   Chart Service                   */
                /* ==================================================*/
                $Sjan = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','01')
                ->whereYear('tanggal_fs',$tahun)
                ->sum('service');
                $Sfeb = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','02')
                ->whereYear('tanggal_fs',$tahun)
                ->sum('service');
                $Smar = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','03')
                ->whereYear('tanggal_fs',$tahun)
                ->sum('service');
                $Sapr = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','04')
                ->whereYear('tanggal_fs',$tahun)
                ->sum('service');
                $Smay = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','05')
                ->whereYear('tanggal_fs',$tahun)
                ->sum('service');
                $Sjun = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','06')
                ->whereYear('tanggal_fs',$tahun)
                ->sum('service');
                $Sjul = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','07')
                ->whereYear('tanggal_fs',$tahun)
                ->sum('service');
                $Saug = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','08')
                ->whereYear('tanggal_fs',$tahun)
                ->sum('service');
                $Ssep = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','09')
                ->whereYear('tanggal_fs',$tahun)
                ->sum('service');
                $Soct = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','10')
                ->whereYear('tanggal_fs',$tahun)
                ->sum('service');
                $Snov = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','11')
                ->whereYear('tanggal_fs',$tahun)
                ->sum('service');
                $Sdec = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','12')
                ->whereYear('tanggal_fs',$tahun)
                ->sum('service');

                // LAST YEAR

                $SjanLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','01')
                ->whereYear('tanggal_fs',$LY)
                ->sum('service');
                $SfebLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','02')
                ->whereYear('tanggal_fs',$LY)
                ->sum('service');
                $SmarLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','03')
                ->whereYear('tanggal_fs',$LY)
                ->sum('service');
                $SaprLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','04')
                ->whereYear('tanggal_fs',$LY)
                ->sum('service');
                $SmayLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','05')
                ->whereYear('tanggal_fs',$LY)
                ->sum('service');
                $SjunLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','06')
                ->whereYear('tanggal_fs',$LY)
                ->sum('service');
                $SjulLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','07')
                ->whereYear('tanggal_fs',$LY)
                ->sum('service');
                $SaugLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','08')
                ->whereYear('tanggal_fs',$LY)
                ->sum('service');
                $SsepLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','09')
                ->whereYear('tanggal_fs',$LY)
                ->sum('service');
                $SoctLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','10')
                ->whereYear('tanggal_fs',$LY)
                ->sum('service');
                $SnovLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','11')
                ->whereYear('tanggal_fs',$LY)
                ->sum('service');
                $SdecLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','12')
                ->whereYear('tanggal_fs',$LY)
                ->sum('service');

                $chartService = new ChartJs;
                $chartService->title('Service Bisma Group By Months');
                $chartService->displaylegend(true);
                $chartService->labels([
                    'Jan','Feb','Mar','Apr','May','Jun',
                    'Jul','Aug','Sep','Oct','Nov','Des'
                ]);

                $chartService->dataset($tahun, 'bar', [
                    $Sjan, $Sfeb, $Smar, $Sapr, $Smay, $Sjun,
                    $Sjul, $Saug, $Ssep, $Soct, $Snov, $Sdec
                ])
                ->color([
                    "#171791","#484FE1","#227DE3","#234C8A","#436ABA","#162FAB",
                    "#2581B0","#5939D0","#4F3BB6","#2E3875","#253BDD","#1E36C6"
                ])
                ->backgroundcolor([
                    "#171791","#484FE1","#227DE3","#234C8A","#436ABA","#162FAB",
                    "#2581B0","#5939D0","#4F3BB6","#2E3875","#253BDD","#1E36C6"
                ]);

                $chartService->dataset($LY, 'bar', [
                    $SjanLY, $SfebLY, $SmarLY, $SaprLY, $SmayLY, $SjunLY,
                    $SjulLY, $SaugLY, $SsepLY, $SoctLY, $SnovLY, $SdecLY
                ])
                ->color("#010101")
                ->backgroundcolor("#010101");
                /** =================================================*/
                /*                 END Chart Service                 */
                /* ==================================================*/
                
                /** =================================================*/
                /*                  5 STOK TERBANYAK                 */
                /* ==================================================*/

                $stok1 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'))
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->limit(1)
                ->pluck('jumlah');

                $stok2 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'))
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(1)
                ->take(1)
                ->pluck('jumlah');
                
                $stok3 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'))
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(2)
                ->take(1)
                ->pluck('jumlah');

                $stok4 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'))
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(3)
                ->take(1)
                ->pluck('jumlah');

                $stok5 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'))
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(4)
                ->take(1)
                ->pluck('jumlah');

                $motor1 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'), 'nama_motor')
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->limit(1)
                ->pluck('nama_motor');

                $motor2 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'), 'nama_motor')
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(1)
                ->take(1)
                ->pluck('nama_motor');

                $motor3 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'), 'nama_motor')
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(2)
                ->take(1)
                ->pluck('nama_motor');

                $motor4 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'), 'nama_motor')
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(3)
                ->take(1)
                ->pluck('nama_motor');

                $motor5 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'), 'nama_motor')
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(4)
                ->take(1)
                ->pluck('nama_motor');

                $chartStokTerbanyak = new MinimalistChartJs;
                $chartStokTerbanyak->title('Stok Terbanyak Bisma Group');
                $chartStokTerbanyak->displaylegend(true);
                $chartStokTerbanyak->labels([
                    $motor1, $motor2, $motor3, $motor4, $motor5
                ]);
                $chartStokTerbanyak->dataset("Stok", 'doughnut', [
                    $stok1, $stok2, $stok3, $stok4, $stok5
                ])
                ->color([
                    "#004182","#118DF0","#FBFFA3","#FF4B68","#3A9679"
                ])
                ->backgroundcolor([
                    "#004182","#118DF0","#FBFFA3","#FF4B68","#3A9679"
                ]);
                /** =================================================*/
                /*                END 5 STOK TERBANYAK               */
                /* ==================================================*/

                /** =================================================*/
                /*                  5 UNIT TERLARIS                  */
                /* ==================================================*/
                $qty1 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->whereYear('tanggal_jual',$tahun)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->limit(1)
                ->pluck('jumlah');

                $qty2 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->whereYear('tanggal_jual',$tahun)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(1)
                ->take(1)
                ->pluck('jumlah');
                
                $qty3 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->whereYear('tanggal_jual',$tahun)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(2)
                ->take(1)
                ->pluck('jumlah');

                $qty4 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->whereYear('tanggal_jual',$tahun)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(3)
                ->take(1)
                ->pluck('jumlah');

                $qty5 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->whereYear('tanggal_jual',$tahun)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(4)
                ->take(1)
                ->pluck('jumlah');

                $unit1 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->whereYear('tanggal_jual',$tahun)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->limit(1)
                ->pluck('nama_motor');

                $unit2 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->whereYear('tanggal_jual',$tahun)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(1)
                ->take(1)
                ->pluck('nama_motor');

                $unit3 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->whereYear('tanggal_jual',$tahun)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(2)
                ->take(1)
                ->pluck('nama_motor');

                $unit4 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->whereYear('tanggal_jual',$tahun)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(3)
                ->take(1)
                ->pluck('nama_motor');

                $unit5 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->whereYear('tanggal_jual',$tahun)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(4)
                ->take(1)
                ->pluck('nama_motor');

                $chartUnitTerlaris = new MinimalistChartJs;
                $chartUnitTerlaris->title('Best Selling Bisma Group');
                $chartUnitTerlaris->displaylegend(true);
                $chartUnitTerlaris->labels([
                    $unit1, $unit2, $unit3, $unit4, $unit5
                ]);
                $chartUnitTerlaris->dataset("Unit", 'pie', [
                    $qty1, $qty2, $qty3, $qty4, $qty5
                ])
                ->color([
                    "#004182","#118DF0","#FBFFA3","#FF4B68","#3A9679"
                ])
                ->backgroundcolor([
                    "#004182","#118DF0","#FBFFA3","#FF4B68","#3A9679"
                ]);
                /** =================================================*/
                /*                 END 5 UNIT TERLARIS               */
                /* ==================================================*/

                /** =================================================*/
                /*                        PSI                        */
                /* ==================================================*/
                // KELUAR
                $jual1 = DB::table('juals')
                ->whereMonth('tanggal_jual','01')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');
                $keluar1 = DB::table('keluars')
                ->whereMonth('tanggal_keluar','01')
                ->whereYear('tanggal_keluar',$tahun)
                ->sum('qty_out');
                $out1 = $jual1 + $keluar1;

                $jual2 = DB::table('juals')
                ->whereMonth('tanggal_jual','02')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');
                $keluar2 = DB::table('keluars')
                ->whereMonth('tanggal_keluar','02')
                ->whereYear('tanggal_keluar',$tahun)
                ->sum('qty_out');
                $out2 = $jual2 + $keluar2;

                $jual3 = DB::table('juals')
                ->whereMonth('tanggal_jual','03')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');
                $keluar3 = DB::table('keluars')
                ->whereMonth('tanggal_keluar','03')
                ->whereYear('tanggal_keluar',$tahun)
                ->sum('qty_out');
                $out3 = $jual3 + $keluar3;

                $jual4 = DB::table('juals')
                ->whereMonth('tanggal_jual','04')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');
                $keluar4 = DB::table('keluars')
                ->whereMonth('tanggal_keluar','04')
                ->whereYear('tanggal_keluar',$tahun)
                ->sum('qty_out');
                $out4 = $jual4 + $keluar4;

                $jual5 = DB::table('juals')
                ->whereMonth('tanggal_jual','05')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');
                $keluar5 = DB::table('keluars')
                ->whereMonth('tanggal_keluar','05')
                ->whereYear('tanggal_keluar',$tahun)
                ->sum('qty_out');
                $out5 = $jual5 + $keluar5;

                $jual6 = DB::table('juals')
                ->whereMonth('tanggal_jual','06')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');
                $keluar6 = DB::table('keluars')
                ->whereMonth('tanggal_keluar','06')
                ->whereYear('tanggal_keluar',$tahun)
                ->sum('qty_out');
                $out6 = $jual6 + $keluar6;

                $jual7 = DB::table('juals')
                ->whereMonth('tanggal_jual','07')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');
                $keluar7 = DB::table('keluars')
                ->whereMonth('tanggal_keluar','07')
                ->whereYear('tanggal_keluar',$tahun)
                ->sum('qty_out');
                $out7 = $jual7 + $keluar7;

                $jual8 = DB::table('juals')
                ->whereMonth('tanggal_jual','08')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');
                $keluar8 = DB::table('keluars')
                ->whereMonth('tanggal_keluar','08')
                ->whereYear('tanggal_keluar',$tahun)
                ->sum('qty_out');
                $out8 = $jual8 + $keluar8;

                $jual9 = DB::table('juals')
                ->whereMonth('tanggal_jual','09')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');
                $keluar9 = DB::table('keluars')
                ->whereMonth('tanggal_keluar','09')
                ->whereYear('tanggal_keluar',$tahun)
                ->sum('qty_out');
                $out9 = $jual9 + $keluar9;

                $jual10 = DB::table('juals')
                ->whereMonth('tanggal_jual','10')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');
                $keluar10 = DB::table('keluars')
                ->whereMonth('tanggal_keluar','10')
                ->whereYear('tanggal_keluar',$tahun)
                ->sum('qty_out');
                $out10 = $jual10 + $keluar10;

                $jual11 = DB::table('juals')
                ->whereMonth('tanggal_jual','11')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');
                $keluar11 = DB::table('keluars')
                ->whereMonth('tanggal_keluar','11')
                ->whereYear('tanggal_keluar',$tahun)
                ->sum('qty_out');
                $out11 = $jual11 + $keluar11;

                $jual12 = DB::table('juals')
                ->whereMonth('tanggal_jual','12')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');
                $keluar12 = DB::table('keluars')
                ->whereMonth('tanggal_keluar','12')
                ->whereYear('tanggal_keluar',$tahun)
                ->sum('qty_out');
                $out12 = $jual12 + $keluar12;
                // END KELUAR

                // MASUK
                $in1 = DB::table('masuks')
                ->whereMonth('tanggal_masuk','01')
                ->whereYear('tanggal_masuk',$tahun)
                ->sum('qty_in');

                $in2 = DB::table('masuks')
                ->whereMonth('tanggal_masuk','02')
                ->whereYear('tanggal_masuk',$tahun)
                ->sum('qty_in');

                $in3 = DB::table('masuks')
                ->whereMonth('tanggal_masuk','03')
                ->whereYear('tanggal_masuk',$tahun)
                ->sum('qty_in');

                $in4 = DB::table('masuks')
                ->whereMonth('tanggal_masuk','04')
                ->whereYear('tanggal_masuk',$tahun)
                ->sum('qty_in');

                $in5 = DB::table('masuks')
                ->whereMonth('tanggal_masuk','05')
                ->whereYear('tanggal_masuk',$tahun)
                ->sum('qty_in');

                $in6 = DB::table('masuks')
                ->whereMonth('tanggal_masuk','06')
                ->whereYear('tanggal_masuk',$tahun)
                ->sum('qty_in');

                $in7 = DB::table('masuks')
                ->whereMonth('tanggal_masuk','07')
                ->whereYear('tanggal_masuk',$tahun)
                ->sum('qty_in');

                $in8 = DB::table('masuks')
                ->whereMonth('tanggal_masuk','08')
                ->whereYear('tanggal_masuk',$tahun)
                ->sum('qty_in');

                $in9 = DB::table('masuks')
                ->whereMonth('tanggal_masuk','09')
                ->whereYear('tanggal_masuk',$tahun)
                ->sum('qty_in');

                $in10 = DB::table('masuks')
                ->whereMonth('tanggal_masuk','10')
                ->whereYear('tanggal_masuk',$tahun)
                ->sum('qty_in');

                $in11 = DB::table('masuks')
                ->whereMonth('tanggal_masuk','11')
                ->whereYear('tanggal_masuk',$tahun)
                ->sum('qty_in');

                $in12 = DB::table('masuks')
                ->whereMonth('tanggal_masuk','12')
                ->whereYear('tanggal_masuk',$tahun)
                ->sum('qty_in');
                // END MASUK

                // // STOK
                // $stk1 = DB::table('stoks')
                // ->sum('stok');
                // // END STOK

                $chartPSI = new ChartJs;
                $chartPSI->title('Purchase Stock Inventory');
                $chartPSI->displaylegend(true);
                $chartPSI->labels([
                    'Jan', 'Feb', 'Mar', 'Apr', 'May','Jun', 'Jul', 'Aug', 'Sep','Oct', 'Nov', 'Dec'
                ]);
                $chartPSI->dataset("Out", 'bar', [
                    $out1, $out2, $out3, $out4, $out5, $out6, $out7, $out8, $out9, $out10, $out11, $out12
                ])
                ->color("#004182")
                ->backgroundcolor("#004182");
                
                $chartPSI->dataset("In", 'bar', [
                    $in1, $in2, $in3, $in4, $in5, $in6, $in7, $in8, $in9, $in10, $in11, $in12
                ])
                ->color("#FF4B68")
                ->backgroundcolor("#FF4B68");

                // $chartPSI->dataset("Stock", 'bar', [
                //     $stk1, $stk2, $stk3, $stk4, $stk5, $stk6, $stk7, $stk8, $stk9, $stk10, $stk11, $stk12
                // ])
                // ->color("#FFB830")
                // ->backgroundcolor("#FFB830");

                // $chartPSI->dataset("Ratio", 'line', [
                //     $ratio1, $ratio2, $ratio3, $ratio4, $ratio5, $ratio6, $ratio7, $ratio8, $ratio9, $ratio10, $ratio11, $ratio12
                // ])
                // ->color("#57CC99")
                // ->backgroundcolor("#57CC99");
                /** =================================================*/
                /*                      END PSI                      */
                /* ==================================================*/
            
            // IF DEALER
            }else{
                // Unit Terjual TAHUN by Dealer
                $yearSale = DB::table('juals')
                ->whereYear('tanggal_jual',$tahun)
                ->where('dealer_kode',$kode_dealer)
                ->sum('qty');

                // Unit Terjual BULAN by Dealer
                $monthSale = DB::table('juals')
                ->whereYear('tanggal_jual',$tahun)
                ->whereMonth('tanggal_jual',$bulan)
                ->where('dealer_kode',$kode_dealer)
                ->sum('qty');

                // Unit Terjual HARI by Dealer
                $daySale = DB::table('juals')
                ->whereYear('tanggal_jual',$tahun)
                ->whereMonth('tanggal_jual',$bulan)
                ->whereDay('tanggal_jual',$hari)
                ->where('dealer_kode',$kode_dealer)
                ->sum('qty');

                //Detail Unit Terjual TAHUN
                $yearSaleDetail = DB::table('juals')
                ->join('dealers','juals.dealer_kode','=','dealers.kode_dealer')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_dealer')
                ->whereYear('tanggal_jual',$tahun)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_dealer')
                ->get();

                //Detail Unit Terjual BULAN
                $monthSaleDetail = DB::table('juals')
                ->whereYear('tanggal_jual',$tahun)
                ->whereMonth('tanggal_jual',$bulan)
                ->get();

                //Detail Unit Terjual HARI
                $daySaleDetail = DB::table('juals')
                ->whereYear('tanggal_jual',$tahun)
                ->whereMonth('tanggal_jual',$bulan)
                ->whereDay('tanggal_jual',$hari)
                ->get();

                /** =================================================*/
                /*                   Chart penjualan                 */
                /* ==================================================*/
                $jan = DB::table('juals')
                ->whereMonth('tanggal_jual','01')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $feb = DB::table('juals')
                ->whereMonth('tanggal_jual','02')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $mar = DB::table('juals')
                ->whereMonth('tanggal_jual','03')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $apr = DB::table('juals')
                ->whereMonth('tanggal_jual','04')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $may = DB::table('juals')
                ->whereMonth('tanggal_jual','05')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $jun = DB::table('juals')
                ->whereMonth('tanggal_jual','06')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $jul = DB::table('juals')
                ->whereMonth('tanggal_jual','07')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $aug = DB::table('juals')
                ->whereMonth('tanggal_jual','08')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $sep = DB::table('juals')
                ->whereMonth('tanggal_jual','09')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $oct = DB::table('juals')
                ->whereMonth('tanggal_jual','10')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $nov = DB::table('juals')
                ->whereMonth('tanggal_jual','11')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                $dec = DB::table('juals')
                ->whereMonth('tanggal_jual','12')
                ->whereYear('tanggal_jual',$tahun)
                ->sum('qty');

                //LAST YEAR 

                $janLY = DB::table('juals')
                ->whereMonth('tanggal_jual','01')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $febLY = DB::table('juals')
                ->whereMonth('tanggal_jual','02')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $marLY = DB::table('juals')
                ->whereMonth('tanggal_jual','03')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $aprLY = DB::table('juals')
                ->whereMonth('tanggal_jual','04')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $mayLY = DB::table('juals')
                ->whereMonth('tanggal_jual','05')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $junLY = DB::table('juals')
                ->whereMonth('tanggal_jual','06')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $julLY = DB::table('juals')
                ->whereMonth('tanggal_jual','07')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $augLY = DB::table('juals')
                ->whereMonth('tanggal_jual','08')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $sepLY = DB::table('juals')
                ->whereMonth('tanggal_jual','09')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $octLY = DB::table('juals')
                ->whereMonth('tanggal_jual','10')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $novLY = DB::table('juals')
                ->whereMonth('tanggal_jual','11')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $decLY = DB::table('juals')
                ->whereMonth('tanggal_jual','12')
                ->whereYear('tanggal_jual',$LY)
                ->sum('qty');

                $chartJual = new ChartJs;
                $chartJual->title('Penjualan Unit '.$nama_dealer.' By Months');
                $chartJual->displaylegend(true);
                $chartJual->labels([
                    'Jan','Feb','Mar','Apr','May','Jun',
                    'Jul','Aug','Sep','Oct','Nov','Des'
                ]);

                $chartJual->dataset($tahun, 'line', [
                    $jan, $feb, $mar, $apr, $may, $jun,
                    $jul, $aug, $sep, $oct, $nov, $dec
                ])
                ->color("#233699")
                ->backgroundcolor("rgba(17,55,192,0.4)")
                ->linetension(0.0);

                $chartJual->dataset($LY, 'line', [
                    $janLY, $febLY, $marLY, $aprLY, $mayLY, $junLY,
                    $julLY, $augLY, $sepLY, $octLY, $novLY, $decLY
                ])
                ->color("#EB9D22")
                ->backgroundcolor("rgba(231,180,24,0.4)")
                ->linetension(0.0);
                /** =================================================*/
                /*                 END Chart penjualan               */
                /* ==================================================*/

                /** =================================================*/
                /*                   Chart Service                   */
                /* ==================================================*/
                $Sjan = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','01')
                ->whereYear('tanggal_fs',$tahun)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $Sfeb = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','02')
                ->whereYear('tanggal_fs',$tahun)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $Smar = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','03')
                ->whereYear('tanggal_fs',$tahun)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $Sapr = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','04')
                ->whereYear('tanggal_fs',$tahun)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $Smay = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','05')
                ->whereYear('tanggal_fs',$tahun)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $Sjun = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','06')
                ->whereYear('tanggal_fs',$tahun)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $Sjul = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','07')
                ->whereYear('tanggal_fs',$tahun)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $Saug = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','08')
                ->whereYear('tanggal_fs',$tahun)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $Ssep = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','09')
                ->whereYear('tanggal_fs',$tahun)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $Soct = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','10')
                ->whereYear('tanggal_fs',$tahun)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $Snov = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','11')
                ->whereYear('tanggal_fs',$tahun)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $Sdec = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','12')
                ->whereYear('tanggal_fs',$tahun)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');

                // LAST YEAR

                $SjanLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','01')
                ->whereYear('tanggal_fs',$LY)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $SfebLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','02')
                ->whereYear('tanggal_fs',$LY)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $SmarLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','03')
                ->whereYear('tanggal_fs',$LY)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $SaprLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','04')
                ->whereYear('tanggal_fs',$LY)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $SmayLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','05')
                ->whereYear('tanggal_fs',$LY)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $SjunLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','06')
                ->whereYear('tanggal_fs',$LY)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $SjulLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','07')
                ->whereYear('tanggal_fs',$LY)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $SaugLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','08')
                ->whereYear('tanggal_fs',$LY)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $SsepLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','09')
                ->whereYear('tanggal_fs',$LY)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $SoctLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','10')
                ->whereYear('tanggal_fs',$LY)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $SnovLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','11')
                ->whereYear('tanggal_fs',$LY)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');
                $SdecLY = DB::table('faktur_services')
                ->whereMonth('tanggal_fs','12')
                ->whereYear('tanggal_fs',$LY)
                ->where('dealer_kode',$kode_dealer)
                ->sum('service');

                $chartService = new ChartJs;
                $chartService->title('Service '.$nama_dealer.' By Months');
                $chartService->displaylegend(true);
                $chartService->labels([
                    'Jan','Feb','Mar','Apr','May','Jun',
                    'Jul','Aug','Sep','Oct','Nov','Des'
                ]);

                $chartService->dataset($tahun, 'bar', [
                    $Sjan, $Sfeb, $Smar, $Sapr, $Smay, $Sjun,
                    $Sjul, $Saug, $Ssep, $Soct, $Snov, $Sdec
                ])
                ->color([
                    "#171791","#484FE1","#227DE3","#234C8A","#436ABA","#162FAB",
                    "#2581B0","#5939D0","#4F3BB6","#2E3875","#253BDD","#1E36C6"
                ])
                ->backgroundcolor([
                    "#171791","#484FE1","#227DE3","#234C8A","#436ABA","#162FAB",
                    "#2581B0","#5939D0","#4F3BB6","#2E3875","#253BDD","#1E36C6"
                ]);

                $chartService->dataset($LY, 'bar', [
                    $SjanLY, $SfebLY, $SmarLY, $SaprLY, $SmayLY, $SjunLY,
                    $SjulLY, $SaugLY, $SsepLY, $SoctLY, $SnovLY, $SdecLY
                ])
                ->color("#010101")
                ->backgroundcolor("#010101");
                /** =================================================*/
                /*                 END Chart Service                 */
                /* ==================================================*/
                
                /** =================================================*/
                /*                  5 STOK TERBANYAK                 */
                /* ==================================================*/

                $stok1 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'))
                ->where('dealer_kode',$kode_dealer)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->limit(1)
                ->pluck('jumlah');

                $stok2 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'))
                ->where('dealer_kode',$kode_dealer)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(1)
                ->take(1)
                ->pluck('jumlah');
                
                $stok3 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'))
                ->where('dealer_kode',$kode_dealer)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(2)
                ->take(1)
                ->pluck('jumlah');

                $stok4 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'))
                ->where('dealer_kode',$kode_dealer)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(3)
                ->take(1)
                ->pluck('jumlah');

                $stok5 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'))
                ->where('dealer_kode',$kode_dealer)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(4)
                ->take(1)
                ->pluck('jumlah');

                $motor1 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'), 'nama_motor')
                ->where('dealer_kode',$kode_dealer)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->limit(1)
                ->pluck('nama_motor');

                $motor2 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'), 'nama_motor')
                ->where('dealer_kode',$kode_dealer)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(1)
                ->take(1)
                ->pluck('nama_motor');

                $motor3 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'), 'nama_motor')
                ->where('dealer_kode',$kode_dealer)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(2)
                ->take(1)
                ->pluck('nama_motor');

                $motor4 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'), 'nama_motor')
                ->where('dealer_kode',$kode_dealer)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(3)
                ->take(1)
                ->pluck('nama_motor');

                $motor5 = DB::table('stoks')
                ->select(DB::raw('SUM(stok) as jumlah'), 'nama_motor')
                ->where('dealer_kode',$kode_dealer)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(4)
                ->take(1)
                ->pluck('nama_motor');

                $chartStokTerbanyak = new MinimalistChartJs;
                $chartStokTerbanyak->title('Stok Terbanyak Bisma Group');
                $chartStokTerbanyak->displaylegend(true);
                $chartStokTerbanyak->labels([
                    $motor1, $motor2, $motor3, $motor4, $motor5
                ]);
                $chartStokTerbanyak->dataset("Stok", 'doughnut', [
                    $stok1, $stok2, $stok3, $stok4, $stok5
                ])
                ->color([
                    "#004182","#118DF0","#FBFFA3","#FF4B68","#3A9679"
                ])
                ->backgroundcolor([
                    "#004182","#118DF0","#FBFFA3","#FF4B68","#3A9679"
                ]);
                /** =================================================*/
                /*                END 5 STOK TERBANYAK               */
                /* ==================================================*/

                /** =================================================*/
                /*                  5 UNIT TERLARIS                  */
                /* ==================================================*/
                $qty1 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->where('juals.dealer_kode',$kode_dealer)
                ->whereYear('tanggal_jual',$tahun)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->limit(1)
                ->pluck('jumlah');

                $qty2 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->where('juals.dealer_kode',$kode_dealer)
                ->whereYear('tanggal_jual',$tahun)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(1)
                ->take(1)
                ->pluck('jumlah');
                
                $qty3 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->where('juals.dealer_kode',$kode_dealer)
                ->whereYear('tanggal_jual',$tahun)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(2)
                ->take(1)
                ->pluck('jumlah');

                $qty4 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->where('juals.dealer_kode',$kode_dealer)
                ->whereYear('tanggal_jual',$tahun)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(3)
                ->take(1)
                ->pluck('jumlah');

                $qty5 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->where('juals.dealer_kode',$kode_dealer)
                ->whereYear('tanggal_jual',$tahun)
                ->groupBy('nama_motor')
                ->orderBy('jumlah','desc')
                ->skip(4)
                ->take(1)
                ->pluck('jumlah');

                $unit1 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->where('juals.dealer_kode',$kode_dealer)
                ->whereYear('tanggal_jual',$tahun)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->limit(1)
                ->pluck('nama_motor');

                $unit2 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->where('juals.dealer_kode',$kode_dealer)
                ->whereYear('tanggal_jual',$tahun)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(1)
                ->take(1)
                ->pluck('nama_motor');

                $unit3 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->where('juals.dealer_kode',$kode_dealer)
                ->whereYear('tanggal_jual',$tahun)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(2)
                ->take(1)
                ->pluck('nama_motor');

                $unit4 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->where('juals.dealer_kode',$kode_dealer)
                ->whereYear('tanggal_jual',$tahun)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(3)
                ->take(1)
                ->pluck('nama_motor');

                $unit5 = DB::table('juals')
                ->join('stoks','juals.stok_id','=','stoks.id_stok')
                ->select(DB::raw('SUM(qty) as jumlah'), 'nama_motor')
                ->where('juals.dealer_kode',$kode_dealer)
                ->whereYear('tanggal_jual',$tahun)
                ->orderBy('jumlah','desc')
                ->groupBy('nama_motor')
                ->skip(4)
                ->take(1)
                ->pluck('nama_motor');

                $chartUnitTerlaris = new MinimalistChartJs;
                $chartUnitTerlaris->title('Best Selling Bisma Group');
                $chartUnitTerlaris->displaylegend(true);
                $chartUnitTerlaris->labels([
                    $unit1, $unit2, $unit3, $unit4, $unit5
                ]);
                $chartUnitTerlaris->dataset("Unit", 'pie', [
                    $qty1, $qty2, $qty3, $qty4, $qty5
                ])
                ->color([
                    "#004182","#118DF0","#FBFFA3","#FF4B68","#3A9679"
                ])
                ->backgroundcolor([
                    "#004182","#118DF0","#FBFFA3","#FF4B68","#3A9679"
                ]);
                /** =================================================*/
                /*                 END 5 UNIT TERLARIS               */
                /* ==================================================*/

            }
            
            /** =================GENERAL VIEW====================*/
            /*            Chart penjualan by DEALER              */
            /* ==================================================*/

            //------------------------------------//
            //              SENTRAL               //
            //------------------------------------//
            $jan01 = DB::table('juals')
            ->whereMonth('tanggal_jual','01')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0101')
            ->sum('qty');

            $feb01 = DB::table('juals')
            ->whereMonth('tanggal_jual','02')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0101')
            ->sum('qty');

            $mar01 = DB::table('juals')
            ->whereMonth('tanggal_jual','03')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0101')
            ->sum('qty');

            $apr01 = DB::table('juals')
            ->whereMonth('tanggal_jual','04')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0101')
            ->sum('qty');

            $may01 = DB::table('juals')
            ->whereMonth('tanggal_jual','05')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0101')
            ->sum('qty');

            $jun01 = DB::table('juals')
            ->whereMonth('tanggal_jual','06')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0101')
            ->sum('qty');

            $jul01 = DB::table('juals')
            ->whereMonth('tanggal_jual','07')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0101')
            ->sum('qty');

            $aug01 = DB::table('juals')
            ->whereMonth('tanggal_jual','08')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0101')
            ->sum('qty');

            $sep01 = DB::table('juals')
            ->whereMonth('tanggal_jual','09')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0101')
            ->sum('qty');

            $oct01 = DB::table('juals')
            ->whereMonth('tanggal_jual','10')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0101')
            ->sum('qty');

            $nov01 = DB::table('juals')
            ->whereMonth('tanggal_jual','11')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0101')
            ->sum('qty');

            $dec01 = DB::table('juals')
            ->whereMonth('tanggal_jual','12')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0101')
            ->sum('qty');
            

            //------------------------------------//
            //                 BMM                //
            //------------------------------------//
            $jan02 = DB::table('juals')
            ->whereMonth('tanggal_jual','01')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0102')
            ->sum('qty');

            $feb02 = DB::table('juals')
            ->whereMonth('tanggal_jual','02')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0102')
            ->sum('qty');

            $mar02 = DB::table('juals')
            ->whereMonth('tanggal_jual','03')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0102')
            ->sum('qty');

            $apr02 = DB::table('juals')
            ->whereMonth('tanggal_jual','04')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0102')
            ->sum('qty');

            $may02 = DB::table('juals')
            ->whereMonth('tanggal_jual','05')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0102')
            ->sum('qty');

            $jun02 = DB::table('juals')
            ->whereMonth('tanggal_jual','06')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0102')
            ->sum('qty');

            $jul02 = DB::table('juals')
            ->whereMonth('tanggal_jual','07')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0102')
            ->sum('qty');

            $aug02 = DB::table('juals')
            ->whereMonth('tanggal_jual','08')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0102')
            ->sum('qty');

            $sep02 = DB::table('juals')
            ->whereMonth('tanggal_jual','09')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0102')
            ->sum('qty');

            $oct02 = DB::table('juals')
            ->whereMonth('tanggal_jual','10')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0102')
            ->sum('qty');

            $nov02 = DB::table('juals')
            ->whereMonth('tanggal_jual','11')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0102')
            ->sum('qty');

            $dec02 = DB::table('juals')
            ->whereMonth('tanggal_jual','12')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0102')
            ->sum('qty');

            //------------------------------------//
            //            UD BISMA                //
            //------------------------------------//
            $jan04 = DB::table('juals')
            ->whereMonth('tanggal_jual','01')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104')
            ->sum('qty');

            $feb04 = DB::table('juals')
            ->whereMonth('tanggal_jual','02')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104')
            ->sum('qty');

            $mar04 = DB::table('juals')
            ->whereMonth('tanggal_jual','03')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104')
            ->sum('qty');

            $apr04 = DB::table('juals')
            ->whereMonth('tanggal_jual','04')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104')
            ->sum('qty');

            $may04 = DB::table('juals')
            ->whereMonth('tanggal_jual','05')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104')
            ->sum('qty');

            $jun04 = DB::table('juals')
            ->whereMonth('tanggal_jual','06')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104')
            ->sum('qty');

            $jul04 = DB::table('juals')
            ->whereMonth('tanggal_jual','07')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104')
            ->sum('qty');

            $aug04 = DB::table('juals')
            ->whereMonth('tanggal_jual','08')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104')
            ->sum('qty');

            $sep04 = DB::table('juals')
            ->whereMonth('tanggal_jual','09')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104')
            ->sum('qty');

            $oct04 = DB::table('juals')
            ->whereMonth('tanggal_jual','10')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104')
            ->sum('qty');

            $nov04 = DB::table('juals')
            ->whereMonth('tanggal_jual','11')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104')
            ->sum('qty');

            $dec04 = DB::table('juals')
            ->whereMonth('tanggal_jual','12')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104')
            ->sum('qty');

            //------------------------------------//
            //                TTS                 //
            //------------------------------------//
            $jan05 = DB::table('juals')
            ->whereMonth('tanggal_jual','01')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0105')
            ->sum('qty');

            $feb05 = DB::table('juals')
            ->whereMonth('tanggal_jual','02')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0105')
            ->sum('qty');

            $mar05 = DB::table('juals')
            ->whereMonth('tanggal_jual','03')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0105')
            ->sum('qty');

            $apr05 = DB::table('juals')
            ->whereMonth('tanggal_jual','04')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0105')
            ->sum('qty');

            $may05 = DB::table('juals')
            ->whereMonth('tanggal_jual','05')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0105')
            ->sum('qty');

            $jun05 = DB::table('juals')
            ->whereMonth('tanggal_jual','06')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0105')
            ->sum('qty');

            $jul05 = DB::table('juals')
            ->whereMonth('tanggal_jual','07')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0105')
            ->sum('qty');

            $aug05 = DB::table('juals')
            ->whereMonth('tanggal_jual','08')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0105')
            ->sum('qty');

            $sep05 = DB::table('juals')
            ->whereMonth('tanggal_jual','09')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0105')
            ->sum('qty');

            $oct05 = DB::table('juals')
            ->whereMonth('tanggal_jual','10')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0105')
            ->sum('qty');

            $nov05 = DB::table('juals')
            ->whereMonth('tanggal_jual','11')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0105')
            ->sum('qty');

            $dec05 = DB::table('juals')
            ->whereMonth('tanggal_jual','12')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0105')
            ->sum('qty');

            //------------------------------------//
            //               IMBO                 //
            //------------------------------------//
            $jan06 = DB::table('juals')
            ->whereMonth('tanggal_jual','01')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0106')
            ->sum('qty');

            $feb06 = DB::table('juals')
            ->whereMonth('tanggal_jual','02')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0106')
            ->sum('qty');

            $mar06 = DB::table('juals')
            ->whereMonth('tanggal_jual','03')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0106')
            ->sum('qty');

            $apr06 = DB::table('juals')
            ->whereMonth('tanggal_jual','04')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0106')
            ->sum('qty');

            $may06 = DB::table('juals')
            ->whereMonth('tanggal_jual','05')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0106')
            ->sum('qty');

            $jun06 = DB::table('juals')
            ->whereMonth('tanggal_jual','06')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0106')
            ->sum('qty');

            $jul06 = DB::table('juals')
            ->whereMonth('tanggal_jual','07')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0106')
            ->sum('qty');

            $aug06 = DB::table('juals')
            ->whereMonth('tanggal_jual','08')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0106')
            ->sum('qty');

            $sep06 = DB::table('juals')
            ->whereMonth('tanggal_jual','09')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0106')
            ->sum('qty');

            $oct06 = DB::table('juals')
            ->whereMonth('tanggal_jual','10')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0106')
            ->sum('qty');

            $nov06 = DB::table('juals')
            ->whereMonth('tanggal_jual','11')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0106')
            ->sum('qty');

            $dec06 = DB::table('juals')
            ->whereMonth('tanggal_jual','12')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0106')
            ->sum('qty');

            //------------------------------------//
            //            MANDIRI                 //
            //------------------------------------//
            $jan07 = DB::table('juals')
            ->whereMonth('tanggal_jual','01')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0107')
            ->sum('qty');

            $feb07 = DB::table('juals')
            ->whereMonth('tanggal_jual','02')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0107')
            ->sum('qty');

            $mar07 = DB::table('juals')
            ->whereMonth('tanggal_jual','03')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0107')
            ->sum('qty');

            $apr07 = DB::table('juals')
            ->whereMonth('tanggal_jual','04')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0107')
            ->sum('qty');

            $may07 = DB::table('juals')
            ->whereMonth('tanggal_jual','05')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0107')
            ->sum('qty');

            $jun07 = DB::table('juals')
            ->whereMonth('tanggal_jual','06')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0107')
            ->sum('qty');

            $jul07 = DB::table('juals')
            ->whereMonth('tanggal_jual','07')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0107')
            ->sum('qty');

            $aug07 = DB::table('juals')
            ->whereMonth('tanggal_jual','08')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0107')
            ->sum('qty');

            $sep07 = DB::table('juals')
            ->whereMonth('tanggal_jual','09')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0107')
            ->sum('qty');

            $oct07 = DB::table('juals')
            ->whereMonth('tanggal_jual','10')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0107')
            ->sum('qty');

            $nov07 = DB::table('juals')
            ->whereMonth('tanggal_jual','11')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0107')
            ->sum('qty');

            $dec07 = DB::table('juals')
            ->whereMonth('tanggal_jual','12')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0107')
            ->sum('qty');


            //------------------------------------//
            //            WR SUPRATMAN            //
            //------------------------------------//
            $jan08 = DB::table('juals')
            ->whereMonth('tanggal_jual','01')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0108')
            ->sum('qty');

            $feb08 = DB::table('juals')
            ->whereMonth('tanggal_jual','02')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0108')
            ->sum('qty');

            $mar08 = DB::table('juals')
            ->whereMonth('tanggal_jual','03')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0108')
            ->sum('qty');

            $apr08 = DB::table('juals')
            ->whereMonth('tanggal_jual','04')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0108')
            ->sum('qty');

            $may08 = DB::table('juals')
            ->whereMonth('tanggal_jual','05')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0108')
            ->sum('qty');

            $jun08 = DB::table('juals')
            ->whereMonth('tanggal_jual','06')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0108')
            ->sum('qty');

            $jul08 = DB::table('juals')
            ->whereMonth('tanggal_jual','07')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0108')
            ->sum('qty');

            $aug08 = DB::table('juals')
            ->whereMonth('tanggal_jual','08')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0108')
            ->sum('qty');

            $sep08 = DB::table('juals')
            ->whereMonth('tanggal_jual','09')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0108')
            ->sum('qty');

            $oct08 = DB::table('juals')
            ->whereMonth('tanggal_jual','10')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0108')
            ->sum('qty');

            $nov08 = DB::table('juals')
            ->whereMonth('tanggal_jual','11')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0108')
            ->sum('qty');

            $dec08 = DB::table('juals')
            ->whereMonth('tanggal_jual','12')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0108')
            ->sum('qty');
            
            //------------------------------------//
            //            SUNSET ROAD             //
            //------------------------------------//
            $jan09 = DB::table('juals')
            ->whereMonth('tanggal_jual','01')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0109')
            ->sum('qty');

            $feb09 = DB::table('juals')
            ->whereMonth('tanggal_jual','02')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0109')
            ->sum('qty');

            $mar09 = DB::table('juals')
            ->whereMonth('tanggal_jual','03')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0109')
            ->sum('qty');

            $apr09 = DB::table('juals')
            ->whereMonth('tanggal_jual','04')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0109')
            ->sum('qty');

            $may09 = DB::table('juals')
            ->whereMonth('tanggal_jual','05')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0109')
            ->sum('qty');

            $jun09 = DB::table('juals')
            ->whereMonth('tanggal_jual','06')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0109')
            ->sum('qty');

            $jul09 = DB::table('juals')
            ->whereMonth('tanggal_jual','07')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0109')
            ->sum('qty');

            $aug09 = DB::table('juals')
            ->whereMonth('tanggal_jual','08')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0109')
            ->sum('qty');

            $sep09 = DB::table('juals')
            ->whereMonth('tanggal_jual','09')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0109')
            ->sum('qty');

            $oct09 = DB::table('juals')
            ->whereMonth('tanggal_jual','10')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0109')
            ->sum('qty');

            $nov09 = DB::table('juals')
            ->whereMonth('tanggal_jual','11')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0109')
            ->sum('qty');

            $dec09 = DB::table('juals')
            ->whereMonth('tanggal_jual','12')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0109')
            ->sum('qty');


            //------------------------------------//
            //                FSS                 //
            //------------------------------------//
            $jan04F = DB::table('juals')
            ->whereMonth('tanggal_jual','01')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104F')
            ->sum('qty');

            $feb04F = DB::table('juals')
            ->whereMonth('tanggal_jual','02')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104F')
            ->sum('qty');

            $mar04F = DB::table('juals')
            ->whereMonth('tanggal_jual','03')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104F')
            ->sum('qty');

            $apr04F = DB::table('juals')
            ->whereMonth('tanggal_jual','04')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104F')
            ->sum('qty');

            $may04F = DB::table('juals')
            ->whereMonth('tanggal_jual','05')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104F')
            ->sum('qty');

            $jun04F = DB::table('juals')
            ->whereMonth('tanggal_jual','06')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104F')
            ->sum('qty');

            $jul04F = DB::table('juals')
            ->whereMonth('tanggal_jual','07')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104F')
            ->sum('qty');

            $aug04F = DB::table('juals')
            ->whereMonth('tanggal_jual','08')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104F')
            ->sum('qty');

            $sep04F = DB::table('juals')
            ->whereMonth('tanggal_jual','09')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104F')
            ->sum('qty');

            $oct04F = DB::table('juals')
            ->whereMonth('tanggal_jual','10')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104F')
            ->sum('qty');

            $nov04F = DB::table('juals')
            ->whereMonth('tanggal_jual','11')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104F')
            ->sum('qty');

            $dec04F = DB::table('juals')
            ->whereMonth('tanggal_jual','12')
            ->whereYear('tanggal_jual',$tahun)
            ->where('dealer_kode','AA0104F')
            ->sum('qty');


            $chartJualbyDealer = new ChartJs;
            $chartJualbyDealer->title('Penjualan Tahun '.$tahun.' By Dealer');
            $chartJualbyDealer->displaylegend(true);
            $chartJualbyDealer->labels([
                'Jan','Feb','Mar','Apr','May','Jun',
                'Jul','Aug','Sep','Oct','Nov','Des'
            ]);

            $chartJualbyDealer->dataset('Sentral', 'line', [
                $jan01, $feb01, $mar01, $apr01, $may01, $jun01,
                $jul01, $aug01, $sep01, $oct01, $nov01, $dec01
            ])
            ->color("#120078")
            ->backgroundcolor("transparent")
            ->linetension(0.5);

            $chartJualbyDealer->dataset('BMM', 'line', [
                $jan02, $feb02, $mar02, $apr02, $may02, $jun02,
                $jul02, $aug02, $sep02, $oct02, $nov02, $dec02
            ])
            ->color("#9d0191")
            ->backgroundcolor("transparent")
            ->linetension(0.5);

            $chartJualbyDealer->dataset('Hasanuddin', 'line', [
                $jan04, $feb04, $mar04, $apr04, $may04, $jun04,
                $jul04, $aug04, $sep04, $oct04, $nov04, $dec04
            ])
            ->color("#fd3a69")
            ->backgroundcolor("transparent")
            ->linetension(0.5);

            $chartJualbyDealer->dataset('TTS', 'line', [
                $jan05, $feb05, $mar05, $apr05, $may05, $jun05,
                $jul05, $aug05, $sep05, $oct05, $nov05, $dec05
            ])
            ->color("#fecd1a")
            ->backgroundcolor("transparent")
            ->linetension(0.5);

            $chartJualbyDealer->dataset('Imbo', 'line', [
                $jan06, $feb06, $mar06, $apr06, $may06, $jun06,
                $jul06, $aug06, $sep06, $oct06, $nov06, $dec06
            ])
            ->color("#16697a")
            ->backgroundcolor("transparent")
            ->linetension(0.5);

            $chartJualbyDealer->dataset('Mandiri', 'line', [
                $jan07, $feb07, $mar07, $apr07, $may07, $jun07,
                $jul07, $aug07, $sep07, $oct07, $nov07, $dec07
            ])
            ->color("#db6400")
            ->backgroundcolor("transparent")
            ->linetension(0.5);

            $chartJualbyDealer->dataset('Supratman', 'line', [
                $jan08, $feb08, $mar08, $apr08, $may08, $jun08,
                $jul08, $aug08, $sep08, $oct08, $nov08, $dec08
            ])
            ->color("#a20a0a")
            ->backgroundcolor("transparent")
            ->linetension(0.5);

            $chartJualbyDealer->dataset('Sunset', 'line', [
                $jan09, $feb09, $mar09, $apr09, $may09, $jun09,
                $jul09, $aug09, $sep09, $oct09, $nov09, $dec09
            ])
            ->color("#61b15a")
            ->backgroundcolor("transparent")
            ->linetension(0.5);

            $chartJualbyDealer->dataset('FSS', 'line', [
                $jan04F, $feb04F, $mar04F, $apr04F, $may04F, $jun04F,
                $jul04F, $aug04F, $sep04F, $oct04F, $nov04F, $dec04F
            ])
            ->color("#393e46")
            ->backgroundcolor("transparent")
            ->linetension(0.5);
            /** =================GENERAL VIEW====================*/
            /*          END Chart penjualan by DEALER            */
            /* ==================================================*/
            
            /** ========= GENERAL VIEW =========== */
            /* Data Nama Motor Cari Unit Dashboard */
            $dataUnit = DB::table('stoks')
            ->groupBy('nama_motor')
            ->get();
            /* =================================== */

            /** ========= GENERAL VIEW =========== */
            /* Data Warna Motor Cari Unit Dashboard */
            $dataWarna = DB::table('warnas')
            ->groupBy('warna')
            ->get();
            /* =================================== */

            
            /** ========= GENERAL VIEW =========== */
            /*               RANKING               */
            /* =================================== */
            $rank1 = DB::table('juals')
            ->join('dealers','juals.dealer_kode','=','dealers.kode_dealer')
            ->select(DB::raw('SUM(juals.qty) as jumlah'), 'dealers.nama_dealer')
            ->whereYear('juals.tanggal_jual',$tahun)
            ->whereMonth('juals.tanggal_jual',$bulan)
            ->groupBy('juals.dealer_kode')
            ->orderBy('jumlah','desc')
            ->limit(1,1)
            ->get();

            $rank2 = DB::table('juals')
            ->join('dealers','juals.dealer_kode','=','dealers.kode_dealer')
            ->select(DB::raw('SUM(juals.qty) as jumlah'), 'dealers.nama_dealer')
            ->whereYear('juals.tanggal_jual',$tahun)
            ->whereMonth('juals.tanggal_jual',$bulan)
            ->groupBy('juals.dealer_kode')
            ->orderBy('jumlah','desc')
            ->skip(1)
            ->take(1)
            ->get();

            $rank3 = DB::table('juals')
            ->join('dealers','juals.dealer_kode','=','dealers.kode_dealer')
            ->select(DB::raw('SUM(juals.qty) as jumlah'), 'dealers.nama_dealer')
            ->whereYear('juals.tanggal_jual',$tahun)
            ->whereMonth('juals.tanggal_jual',$bulan)
            ->groupBy('juals.dealer_kode')
            ->orderBy('jumlah','desc')
            ->skip(2)
            ->take(1)
            ->get();
            /** ========== GENERAL VIEW ========== */
            /*            END RANKING              */
            /* =================================== */

    		return view('inventory.dashboard', compact(
                'title','now','yearSale','monthSale','daySale',
                'yearSaleDetail','monthSaleDetail','daySaleDetail','tahun','bln',
                'chartJual','chartService','chartStokTerbanyak','chartUnitTerlaris',
                'chartJualbyDealer', 'dataUnit', 'dataWarna',
                'tgl_update','data_user','count_user','rank1','rank2','rank3','total'
            ));
    	}
    }

    public function cariUnit(Request $req){
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            $title = "Dashboard";
            $cariUnit = $req->cariUnit;
            $cariWarna = $req->cariWarna;
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');

            if (empty($cariWarna)) {
                $data = DB::table('stoks')
                ->join('dealers','stoks.dealer_kode','=','dealers.kode_dealer')
                ->where([ ['stok','>','0'],['nama_motor','=',$cariUnit], ])
                ->get();
            } elseif(empty($cariUnit)) {
                $data = DB::table('stoks')
                ->join('dealers','stoks.dealer_kode','=','dealers.kode_dealer')
                ->where([ ['stok','>','0'],['warna','=',$cariWarna], ])
                ->get();
            }else{
                $data = DB::table('stoks')
                ->join('dealers','stoks.dealer_kode','=','dealers.kode_dealer')
                ->where([ ['stok','>','0'],['nama_motor','=',$cariUnit],['warna','=',$cariWarna], ])
                ->get();
            }
            
            // Info Summary Data Unit
            $sumUnit = DB::table('stoks')
            ->join('dealers','stoks.dealer_kode','=','dealers.kode_dealer')
            ->where([ ['stok','>','0'],['nama_motor','=',$cariUnit], ])
            ->sum('stok');

            // Info Summary Data Dealer
            $sumDealer = DB::table('stoks')
            ->join('dealers','stoks.dealer_kode','=','dealers.kode_dealer')
            ->where([ ['stok','>','0'],['nama_motor','=',$cariUnit], ])
            ->distinct('dealers.nama_dealer')
            ->count('dealers.nama_dealer');

            // Info Summary Data Warna Unit
            $sumWarna = DB::table('stoks')
            ->join('dealers','stoks.dealer_kode','=','dealers.kode_dealer')
            ->where([ ['stok','>','0'],['nama_motor','=',$cariUnit], ])
            ->distinct('stoks.warna')
            ->count('stoks.warna');

            // Data Nama Motor Cari Unit Dashboard
            $dataUnit = DB::table('stoks')
            ->groupBy('nama_motor')
            ->get();

            $dataWarna = DB::table('warnas')
            ->groupBy('warna')
            ->get();

            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

            return view('inventory.cari_unit', compact('title','now','data','cariUnit','dataUnit','dataWarna','data_user','count_user','sumUnit','sumDealer','sumWarna'));
        }
    }
}
