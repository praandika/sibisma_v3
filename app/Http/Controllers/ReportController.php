<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\StokExport;
use App\Exports\UnitExport;
use App\Exports\PenjualanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Session;
use App\Stok;
use App\Jual;
use App\Masuk;
use App\Keluar;
use App\Dealer;
use DB;
use Carbon;
use PDF;
Use Alert;

class ReportController extends Controller
{
      public function Laporan(){
	  if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $title = "Laporan Stok";
            $tgl = DB::table('juals')->max('tanggal_jual');

            $tglJ01 = DB::table('juals')->where('dealer_kode','AA0101')->max('tanggal_jual');
            $tglM01 = DB::table('masuks')->where('dealer_kode','AA0101')->max('tanggal_masuk');
            $tglK01 = DB::table('keluars')->where('dealer_kode','AA0101')->max('tanggal_keluar');
            $tglFS01 = DB::table('faktur_services')->where('dealer_kode','AA0101')->max('tanggal_fs');

            $tglJ02 = DB::table('juals')->where('dealer_kode','AA0102')->max('tanggal_jual');
            $tglM02 = DB::table('masuks')->where('dealer_kode','AA0102')->max('tanggal_masuk');
            $tglK02 = DB::table('keluars')->where('dealer_kode','AA0102')->max('tanggal_keluar');
            $tglFS02 = DB::table('faktur_services')->where('dealer_kode','AA0102')->max('tanggal_fs');

            $tglJ04 = DB::table('juals')->where('dealer_kode','AA0104')->max('tanggal_jual');
            $tglM04 = DB::table('masuks')->where('dealer_kode','AA0104')->max('tanggal_masuk');
            $tglK04 = DB::table('keluars')->where('dealer_kode','AA0104')->max('tanggal_keluar');
            $tglFS04 = DB::table('faktur_services')->where('dealer_kode','AA0104')->max('tanggal_fs');

            $tglJ05 = DB::table('juals')->where('dealer_kode','AA0105')->max('tanggal_jual');
            $tglM05 = DB::table('masuks')->where('dealer_kode','AA0105')->max('tanggal_masuk');
            $tglK05 = DB::table('keluars')->where('dealer_kode','AA0105')->max('tanggal_keluar');
            $tglFS05 = DB::table('faktur_services')->where('dealer_kode','AA0105')->max('tanggal_fs');

            $tglJ06 = DB::table('juals')->where('dealer_kode','AA0106')->max('tanggal_jual');
            $tglM06 = DB::table('masuks')->where('dealer_kode','AA0106')->max('tanggal_masuk');
            $tglK06 = DB::table('keluars')->where('dealer_kode','AA0106')->max('tanggal_keluar');
            $tglFS06 = DB::table('faktur_services')->where('dealer_kode','AA0106')->max('tanggal_fs');

            $tglJ07 = DB::table('juals')->where('dealer_kode','AA0107')->max('tanggal_jual');
            $tglM07 = DB::table('masuks')->where('dealer_kode','AA0107')->max('tanggal_masuk');
            $tglK07 = DB::table('keluars')->where('dealer_kode','AA0107')->max('tanggal_keluar');
            $tglFS07 = DB::table('faktur_services')->where('dealer_kode','AA0107')->max('tanggal_fs');

            $tglJ08 = DB::table('juals')->where('dealer_kode','AA0108')->max('tanggal_jual');
            $tglM08 = DB::table('masuks')->where('dealer_kode','AA0108')->max('tanggal_masuk');
            $tglK08 = DB::table('keluars')->where('dealer_kode','AA0108')->max('tanggal_keluar');
            $tglFS08 = DB::table('faktur_services')->where('dealer_kode','AA0108')->max('tanggal_fs');

            $tglJ09 = DB::table('juals')->where('dealer_kode','AA0109')->max('tanggal_jual');
            $tglM09 = DB::table('masuks')->where('dealer_kode','AA0109')->max('tanggal_masuk');
            $tglK09 = DB::table('keluars')->where('dealer_kode','AA0109')->max('tanggal_keluar');
            $tglFS09 = DB::table('faktur_services')->where('dealer_kode','AA0109')->max('tanggal_fs');

            $tglJ04F = DB::table('juals')->where('dealer_kode','AA0104F')->max('tanggal_jual');
            $tglM04F = DB::table('masuks')->where('dealer_kode','AA0104F')->max('tanggal_masuk');
            $tglK04F = DB::table('keluars')->where('dealer_kode','AA0104F')->max('tanggal_keluar');
            $tglFS04F = DB::table('faktur_services')->where('dealer_kode','AA0104F')->max('tanggal_fs');

            $tgl01 = max($tglJ01, $tglM01, $tglK01, $tglFS01);
            $tgl02 = max($tglJ02, $tglM02, $tglK02, $tglFS02);
            $tgl04 = max($tglJ04, $tglM04, $tglK04, $tglFS04);
            $tgl05 = max($tglJ05, $tglM05, $tglK05, $tglFS05);
            $tgl06 = max($tglJ06, $tglM06, $tglK06, $tglFS06);
            $tgl07 = max($tglJ07, $tglM07, $tglK07, $tglFS07);
            $tgl08 = max($tglJ08, $tglM08, $tglK08, $tglFS08);
            $tgl09 = max($tglJ09, $tglM09, $tglK09, $tglFS09);
            $tgl04F = max($tglJ04F, $tglM04F, $tglK04F, $tglFS04F);

        	/**
            * SENTRAL =======================================================
            */

            // LAKU :
            $QJ01 = Jual::where([ ['tanggal_jual',$tgl01],['dealer_kode','AA0101'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J01 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl01],['juals.dealer_kode','AA0101'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY01 = Masuk::where([ ['tanggal_masuk',$tgl01],['pemasok','YIMM'],['dealer_kode','AA0101'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY01 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl01],['pemasok','YIMM'],['masuks.dealer_kode','AA0101'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC01 = Masuk::where([ ['tanggal_masuk',$tgl01],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0101'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC01 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl01],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0101'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK01 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl01],['dealer_kode','AA0101'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K01 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl01],['keluars.dealer_kode','AA0101'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS01 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl01],['dealer_kode','AA0101'], ])
            ->get();

            // STOK AKHIR
            $SAk01 = Stok::where('dealer_kode','AA0101')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in01 = $QMC01 + $QMY01;
            $out01 = $QK01 + $QJ01;
            $SAw01 = $SAk01 + $out01 - $in01;

            /**
            * BMM =======================================================
            */

            // LAKU :
            $QJ02 = Jual::where([ ['tanggal_jual',$tgl02],['dealer_kode','AA0102'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J02 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl02],['juals.dealer_kode','AA0102'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY02 = Masuk::where([ ['tanggal_masuk',$tgl02],['pemasok','YIMM'],['dealer_kode','AA0102'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY02 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl02],['pemasok','YIMM'],['masuks.dealer_kode','AA0102'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC02 = Masuk::where([ ['tanggal_masuk',$tgl02],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0102'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC02 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl02],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0102'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK02 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl02],['dealer_kode','AA0102'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K02 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl02],['keluars.dealer_kode','AA0102'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS02 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl02],['dealer_kode','AA0102'], ])
            ->get();

            // STOK AKHIR
            $SAk02 = Stok::where('dealer_kode','AA0102')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in02 = $QMC02 + $QMY02;
            $out02 = $QK02 + $QJ02;
            $SAw02 = $SAk02 + $out02 - $in02;

            /**
            * HASANUDDIN =======================================================
            */

            // LAKU :
            $QJ04 = Jual::where([ ['tanggal_jual',$tgl04],['dealer_kode','AA0104'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J04 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl04],['juals.dealer_kode','AA0104'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY04 = Masuk::where([ ['tanggal_masuk',$tgl04],['pemasok','YIMM'],['dealer_kode','AA0104'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY04 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl04],['pemasok','YIMM'],['masuks.dealer_kode','AA0104'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC04 = Masuk::where([ ['tanggal_masuk',$tgl04],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0104'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC04 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl04],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0104'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK04 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl04],['dealer_kode','AA0104'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K04 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl04],['keluars.dealer_kode','AA0104'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS04 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl04],['dealer_kode','AA0104'], ])
            ->get();

            // STOK AKHIR
            $SAk04 = Stok::where('dealer_kode','AA0104')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in04 = $QMC04 + $QMY04;
            $out04 = $QK04 + $QJ04;
            $SAw04 = $SAk04 + $out04 - $in04;

            /**
            * TTS =======================================================
            */

            // LAKU :
            $QJ05 = Jual::where([ ['tanggal_jual',$tgl05],['dealer_kode','AA0105'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J05 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl05],['juals.dealer_kode','AA0105'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY05 = Masuk::where([ ['tanggal_masuk',$tgl05],['pemasok','YIMM'],['dealer_kode','AA0105'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY05 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl05],['pemasok','YIMM'],['masuks.dealer_kode','AA0105'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC05 = Masuk::where([ ['tanggal_masuk',$tgl05],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0105'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC05 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl05],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0105'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK05 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl05],['dealer_kode','AA0105'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K05 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl05],['keluars.dealer_kode','AA0105'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS05 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl05],['dealer_kode','AA0105'], ])
            ->get();

            // STOK AKHIR
            $SAk05 = Stok::where('dealer_kode','AA0105')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in05 = $QMC05 + $QMY05;
            $out05 = $QK05 + $QJ05;
            $SAw05 = $SAk05 + $out05 - $in05;

            /**
            * IMAM BONJOL =======================================================
            */

            // LAKU :
            $QJ06 = Jual::where([ ['tanggal_jual',$tgl06],['dealer_kode','AA0106'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J06 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl06],['juals.dealer_kode','AA0106'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY06 = Masuk::where([ ['tanggal_masuk',$tgl06],['pemasok','YIMM'],['dealer_kode','AA0106'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY06 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl06],['pemasok','YIMM'],['masuks.dealer_kode','AA0106'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC06 = Masuk::where([ ['tanggal_masuk',$tgl06],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0106'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC06 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl06],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0106'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK06 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl06],['dealer_kode','AA0106'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K06 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl06],['keluars.dealer_kode','AA0106'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS06 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl06],['dealer_kode','AA0106'], ])
            ->get();

            // STOK AKHIR
            $SAk06 = Stok::where('dealer_kode','AA0106')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in06 = $QMC06 + $QMY06;
            $out06 = $QK06 + $QJ06;
            $SAw06 = $SAk06 + $out06 - $in06;

            /**
            * MANDIRI =======================================================
            */

            // LAKU :
            $QJ07 = Jual::where([ ['tanggal_jual',$tgl07],['dealer_kode','AA0107'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J07 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl07],['juals.dealer_kode','AA0107'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY07 = Masuk::where([ ['tanggal_masuk',$tgl07],['pemasok','YIMM'],['dealer_kode','AA0107'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY07 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl07],['pemasok','YIMM'],['masuks.dealer_kode','AA0107'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC07 = Masuk::where([ ['tanggal_masuk',$tgl07],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0107'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC07 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl07],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0107'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK07 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl07],['dealer_kode','AA0107'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K07 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl07],['keluars.dealer_kode','AA0107'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS07 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl07],['dealer_kode','AA0107'], ])
            ->get();

            // STOK AKHIR
            $SAk07 = Stok::where('dealer_kode','AA0107')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in07 = $QMC07 + $QMY07;
            $out07 = $QK07 + $QJ07;
            $SAw07 = $SAk07 + $out07 - $in07;

            /**
            * WR SUPRATMAN =======================================================
            */

            // LAKU :
            $QJ08 = Jual::where([ ['tanggal_jual',$tgl08],['dealer_kode','AA0108'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J08 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl08],['juals.dealer_kode','AA0108'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY08 = Masuk::where([ ['tanggal_masuk',$tgl08],['pemasok','YIMM'],['dealer_kode','AA0108'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY08 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl08],['pemasok','YIMM'],['masuks.dealer_kode','AA0108'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC08 = Masuk::where([ ['tanggal_masuk',$tgl08],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0108'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC08 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl08],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0108'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK08 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl08],['dealer_kode','AA0108'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K08 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl08],['keluars.dealer_kode','AA0108'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS08 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl08],['dealer_kode','AA0108'], ])
            ->get();

            // STOK AKHIR
            $SAk08 = Stok::where('dealer_kode','AA0108')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in08 = $QMC08 + $QMY08;
            $out08 = $QK08 + $QJ08;
            $SAw08 = $SAk08 + $out08 - $in08;

            /**
            * SUNSET ROAD =======================================================
            */

            // LAKU :
            $QJ09 = Jual::where([ ['tanggal_jual',$tgl09],['dealer_kode','AA0109'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J09 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl09],['juals.dealer_kode','AA0109'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY09 = Masuk::where([ ['tanggal_masuk',$tgl09],['pemasok','YIMM'],['dealer_kode','AA0109'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY09 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl09],['pemasok','YIMM'],['masuks.dealer_kode','AA0109'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC09 = Masuk::where([ ['tanggal_masuk',$tgl09],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0109'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC09 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl09],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0109'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK09 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl09],['dealer_kode','AA0109'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K09 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl09],['keluars.dealer_kode','AA0109'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS09 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl09],['dealer_kode','AA0109'], ])
            ->get();

            // STOK AKHIR
            $SAk09 = Stok::where('dealer_kode','AA0109')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in09 = $QMC09 + $QMY09;
            $out09 = $QK09 + $QJ09;
            $SAw09 = $SAk09 + $out09 - $in09;

            /**
            * FLAGSHIP =======================================================
            */

            // LAKU :
            $QJ04F = Jual::where([ ['tanggal_jual',$tgl04F],['dealer_kode','AA0104F'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J04F = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl04F],['juals.dealer_kode','AA0104F'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY04F = Masuk::where([ ['tanggal_masuk',$tgl04F],['pemasok','YIMM'],['dealer_kode','AA0104F'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY04F = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl04F],['pemasok','YIMM'],['masuks.dealer_kode','AA0104F'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC04F = Masuk::where([ ['tanggal_masuk',$tgl04F],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0104F'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC04F = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl04F],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0104F'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK04F = DB::table('keluars')->where([ ['tanggal_keluar',$tgl04F],['dealer_kode','AA0104F'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K04F = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl04F],['keluars.dealer_kode','AA0104F'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS04F = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl04F],['dealer_kode','AA0104F'], ])
            ->get();

            // STOK AKHIR
            $SAk04F = Stok::where('dealer_kode','AA0104F')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in04F = $QMC04F + $QMY04F;
            $out04F = $QK04F + $QJ04F;
            $SAw04F = $SAk04F + $out04F - $in04F;

            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

            return view('report.lap_stok',compact(
                'title', 'tgl','now','data_user','count_user',
                'tgl01','tgl02','tgl04','tgl05','tgl06','tgl07','tgl08','tgl09','tgl04F',
                'QJ01','QMY01','QMC01','QK01','J01','MY01','MC01','K01','SAw01','FS01','SAk01',
                'QJ02','QMY02','QMC02','QK02','J02','MY02','MC02','K02','SAw02','FS02','SAk02',
                'QJ04','QMY04','QMC04','QK04','J04','MY04','MC04','K04','SAw04','FS04','SAk04',
                'QJ05','QMY05','QMC05','QK05','J05','MY05','MC05','K05','SAw05','FS05','SAk05',
                'QJ06','QMY06','QMC06','QK06','J06','MY06','MC06','K06','SAw06','FS06','SAk06',
                'QJ07','QMY07','QMC07','QK07','J07','MY07','MC07','K07','SAw07','FS07','SAk07',
                'QJ08','QMY08','QMC08','QK08','J08','MY08','MC08','K08','SAw08','FS08','SAk08',
                'QJ09','QMY09','QMC09','QK09','J09','MY09','MC09','K09','SAw09','FS09','SAk09',
                'QJ04F','QMY04F','QMC04F','QK04F','J04F','MY04F','MC04F','K04F','SAw04F','FS04F','SAk04F'
            ));
          }
	}

      // ==================CARI LAPORAN=================================
      public function cariLaporan(Request $req){
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $title = "Laporan Stok";
            $tgl = $req->tanggal;

            /**
            * SENTRAL =======================================================
            */

            // LAKU :
            $QJ01 = Jual::where([ ['tanggal_jual',$tgl],['dealer_kode','AA0101'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J01 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl],['juals.dealer_kode','AA0101'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY01 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['dealer_kode','AA0101'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY01 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['masuks.dealer_kode','AA0101'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC01 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0101'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC01 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0101'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK01 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl],['dealer_kode','AA0101'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K01 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl],['keluars.dealer_kode','AA0101'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS01 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl],['dealer_kode','AA0101'], ])
            ->get();

            // STOK AKHIR
            $SAk01 = Stok::where('dealer_kode','AA0101')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in01 = $QMC01 + $QMY01;
            $out01 = $QK01 + $QJ01;
            $SAw01 = $SAk01 + $out01 - $in01;

            /**
            * BMM =======================================================
            */

            // LAKU :
            $QJ02 = Jual::where([ ['tanggal_jual',$tgl],['dealer_kode','AA0102'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J02 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl],['juals.dealer_kode','AA0102'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY02 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['dealer_kode','AA0102'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY02 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['masuks.dealer_kode','AA0102'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC02 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0102'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC02 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0102'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK02 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl],['dealer_kode','AA0102'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K02 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl],['keluars.dealer_kode','AA0102'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS02 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl],['dealer_kode','AA0102'], ])
            ->get();

            // STOK AKHIR
            $SAk02 = Stok::where('dealer_kode','AA0102')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in02 = $QMC02 + $QMY02;
            $out02 = $QK02 + $QJ02;
            $SAw02 = $SAk02 + $out02 - $in02;

            /**
            * HASANUDDIN =======================================================
            */

            // LAKU :
            $QJ04 = Jual::where([ ['tanggal_jual',$tgl],['dealer_kode','AA0104'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J04 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl],['juals.dealer_kode','AA0104'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY04 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['dealer_kode','AA0104'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY04 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['masuks.dealer_kode','AA0104'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC04 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0104'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC04 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0104'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK04 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl],['dealer_kode','AA0104'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K04 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl],['keluars.dealer_kode','AA0104'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS04 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl],['dealer_kode','AA0104'], ])
            ->get();

            // STOK AKHIR
            $SAk04 = Stok::where('dealer_kode','AA0104')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in04 = $QMC04 + $QMY04;
            $out04 = $QK04 + $QJ04;
            $SAw04 = $SAk04 + $out04 - $in04;

            /**
            * TTS =======================================================
            */

            // LAKU :
            $QJ05 = Jual::where([ ['tanggal_jual',$tgl],['dealer_kode','AA0105'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J05 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl],['juals.dealer_kode','AA0105'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY05 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['dealer_kode','AA0105'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY05 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['masuks.dealer_kode','AA0105'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC05 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0105'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC05 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0105'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK05 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl],['dealer_kode','AA0105'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K05 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl],['keluars.dealer_kode','AA0105'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS05 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl],['dealer_kode','AA0105'], ])
            ->get();

            // STOK AKHIR
            $SAk05 = Stok::where('dealer_kode','AA0102')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in05 = $QMC05 + $QMY05;
            $out05 = $QK05 + $QJ05;
            $SAw05 = $SAk05 + $out05 - $in05;

            /**
            * IMAM BONJOL =======================================================
            */

            // LAKU :
            $QJ06 = Jual::where([ ['tanggal_jual',$tgl],['dealer_kode','AA0106'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J06 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl],['juals.dealer_kode','AA0106'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY06 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['dealer_kode','AA0106'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY06 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['masuks.dealer_kode','AA0106'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC06 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0106'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC06 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0106'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK06 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl],['dealer_kode','AA0106'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K06 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl],['keluars.dealer_kode','AA0106'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS06 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl],['dealer_kode','AA0106'], ])
            ->get();

            // STOK AKHIR
            $SAk06 = Stok::where('dealer_kode','AA0106')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in06 = $QMC06 + $QMY06;
            $out06 = $QK06 + $QJ06;
            $SAw06 = $SAk06 + $out06 - $in06;

            /**
            * MANDIRI =======================================================
            */

            // LAKU :
            $QJ07 = Jual::where([ ['tanggal_jual',$tgl],['dealer_kode','AA0107'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J07 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl],['juals.dealer_kode','AA0107'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY07 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['dealer_kode','AA0107'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY07 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['masuks.dealer_kode','AA0107'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC07 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0107'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC07 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0107'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK07 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl],['dealer_kode','AA0107'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K07 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl],['keluars.dealer_kode','AA0107'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS07 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl],['dealer_kode','AA0107'], ])
            ->get();

            // STOK AKHIR
            $SAk07 = Stok::where('dealer_kode','AA0107')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in07 = $QMC07 + $QMY07;
            $out07 = $QK07 + $QJ07;
            $SAw07 = $SAk07 + $out07 - $in07;

            /**
            * WR SUPRATMAN =======================================================
            */

            // LAKU :
            $QJ08 = Jual::where([ ['tanggal_jual',$tgl],['dealer_kode','AA0108'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J08 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl],['juals.dealer_kode','AA0108'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY08 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['dealer_kode','AA0108'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY08 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['masuks.dealer_kode','AA0108'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC08 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0108'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC08 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0108'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK08 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl],['dealer_kode','AA0108'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K08 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl],['keluars.dealer_kode','AA0108'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS08 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl],['dealer_kode','AA0108'], ])
            ->get();

            // STOK AKHIR
            $SAk08 = Stok::where('dealer_kode','AA0108')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in08 = $QMC08 + $QMY08;
            $out08 = $QK08 + $QJ08;
            $SAw08 = $SAk08 + $out08 - $in08;

            /**
            * SUNSET ROAD =======================================================
            */

            // LAKU :
            $QJ09 = Jual::where([ ['tanggal_jual',$tgl],['dealer_kode','AA0109'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J09 = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl],['juals.dealer_kode','AA0109'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY09 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['dealer_kode','AA0109'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY09 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['masuks.dealer_kode','AA0109'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC09 = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0109'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC09 = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0109'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK09 = DB::table('keluars')->where([ ['tanggal_keluar',$tgl],['dealer_kode','AA0109'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K09 = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl],['keluars.dealer_kode','AA0109'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS09 = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl],['dealer_kode','AA0109'], ])
            ->get();

            // STOK AKHIR
            $SAk09 = Stok::where('dealer_kode','AA0109')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in09 = $QMC09 + $QMY09;
            $out09 = $QK09 + $QJ09;
            $SAw09 = $SAk09 + $out09 - $in09;

            /**
            * FLAGSHIP =======================================================
            */

            // LAKU :
            $QJ04F = Jual::where([ ['tanggal_jual',$tgl],['dealer_kode','AA0104F'], ])->sum('qty');
            // DAFTAR UNIT YANG LAKU :
            $J04F = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_jual',$tgl],['juals.dealer_kode','AA0104F'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK YIMM :
            $QMY04F = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['dealer_kode','AA0104F'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI YIMM :
            $MY04F = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','YIMM'],['masuks.dealer_kode','AA0104F'], ])
            ->orderBy('tahun','asc')->get();

            // MASUK CABANG :
            $QMC04F = Masuk::where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0104F'], ])->sum('qty_in');
            // DAFTAR UNIT YANG MASUK DARI CABANG :
            $MC04F = DB::table('masuks')
            ->join('stoks','masuks.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_masuk',$tgl],['pemasok','!=','YIMM'],['masuks.dealer_kode','AA0104F'], ])
            ->orderBy('tahun','asc')->get();

            // KELUAR CABANG :
            $QK04F = DB::table('keluars')->where([ ['tanggal_keluar',$tgl],['dealer_kode','AA0104F'], ])->sum('qty_out');
            // DAFTAR UNIT KELUAR CABANG :
            $K04F = DB::table('keluars')
            ->join('stoks','keluars.stok_id','=','stoks.id_stok')
            ->where([ ['tanggal_keluar',$tgl],['keluars.dealer_kode','AA0104F'], ])
            ->orderBy('tahun','asc')->get();

            // FAKTUR SERVICE
            $FS04F = DB::table('faktur_services')
            ->where([ ['tanggal_fs',$tgl],['dealer_kode','AA0104F'], ])
            ->get();

            // STOK AKHIR
            $SAk04F = Stok::where('dealer_kode','AA0104F')->sum('stok');
            /**
            * Data untuk mendapatkan Stok Awal
            */
            $in04F = $QMC04F + $QMY04F;
            $out04F = $QK04F + $QJ04F;
            $SAw04F = $SAk04F + $out04F - $in04F;


            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();


            return view('report.cari_lap_stok',compact(
                'title', 'tgl','now','data_user','count_user',
                'QJ01','QMY01','QMC01','QK01','J01','MY01','MC01','K01','SAw01','FS01','SAk01',
                'QJ02','QMY02','QMC02','QK02','J02','MY02','MC02','K02','SAw02','FS02','SAk02',
                'QJ04','QMY04','QMC04','QK04','J04','MY04','MC04','K04','SAw04','FS04','SAk04',
                'QJ05','QMY05','QMC05','QK05','J05','MY05','MC05','K05','SAw05','FS05','SAk05',
                'QJ06','QMY06','QMC06','QK06','J06','MY06','MC06','K06','SAw06','FS06','SAk06',
                'QJ07','QMY07','QMC07','QK07','J07','MY07','MC07','K07','SAw07','FS07','SAk07',
                'QJ08','QMY08','QMC08','QK08','J08','MY08','MC08','K08','SAw08','FS08','SAk08',
                'QJ09','QMY09','QMC09','QK09','J09','MY09','MC09','K09','SAw09','FS09','SAk09',
                'QJ04F','QMY04F','QMC04F','QK04F','J04F','MY04F','MC04F','K04F','SAw04F','FS04F','SAk04F'
            ));
          }
      }
      // END CARI LAPORAN ==============================================

    public function StokRpt($home = null){
    	if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
        	if ($home == "AA0101") {
                $title = "Laporan Stok Bisma Sentral";
                $dealer = "Bisma Sentral";
            }elseif ($home == "AA0102") {
                $title = "Laporan Stok Bisma Cokro";
                $dealer = "Bisma Cokro";
            }elseif ($home == "AA0104") {
                $title = "Laporan Stok Bisma Hasanuddin";
                $dealer = "Bisma Hasanuddin";
            }elseif ($home == "AA0105") {
                $title = "Laporan Stok Bisma TTS";
                $dealer = "Bisma TTS";
            }elseif ($home == "AA0106") {
                $title = "Laporan Stok Bisma Imam Bonjol";
                $dealer = "Bisma Imam Bonjol";
            }elseif ($home == "AA0107") {
                $title = "Laporan Stok Bisma Mandiri";
                $dealer = "Bisma Mandiri";
            }elseif ($home == "AA0108") {
                $title = "Laporan Stok Bisma WR Supratman";
                $dealer = "Bisma WR Supratman";
            }elseif ($home == "AA0109") {
                $title = "Laporan Stok Bisma Sunset Road";
                $dealer = "Bisma Sunset Road";
            }elseif ($home == "AA0104F") {
                $title = "Laporan Stok Flagship Shop";
                $dealer = "Flagship Shop";
            }else{
                $title = "Laporan Stok Error";
                $dealer = "Error";
            }

            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $tgl = \Carbon\Carbon::now('GMT+8');
            $data = DB::table('stoks')
            ->join('dealers','stoks.dealer_kode','=','dealers.kode_dealer')
            ->where('stoks.dealer_kode','=',$home)
            ->orderBy('stoks.tahun','desc')
            ->get();
            $stok = DB::table('stoks')
            ->join('dealers','stoks.dealer_kode','=','dealers.kode_dealer')
            ->where('stoks.dealer_kode','=',$home)
            ->orderBy('stoks.tahun','desc')
            ->sum('stok');

            $pdf = PDF::loadview('report.rpt_stok', compact('title','data','stok','tgl','dealer','now','home'));
            return $pdf->download('rpt_stok_'.$home.'_'.$now.'.pdf');
        }
    }

    public function StokExcel($home = null){
    	$now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
    	return (new StokExport)->dealer($home)->download('Stok_'.$home.'_'.$now.'.xlsx');
    }

      public function unit(){
            if (!Session::get('login')) {
                  alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
                  return redirect('/');
            }else{
                  $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
                  $tgl = \Carbon\Carbon::now('GMT+8');
                  $title = 'Daftar Unit';
                  $tahun = DB::table('stoks')
                  ->groupBy('tahun')
                  ->get();

                // Ambil data user login hari ini
                $data_user = DB::table('users')
                ->where('login', 'like', $now.'%')
                ->get();

                // Hitung user login hari ini
                $count_user = DB::table('users')
                ->where('login', 'like', $now.'%')
                ->count();

            return view('report.daftar_stok',compact('tgl','title','tahun','now','data_user','count_user'));
            }
      }

      public function viewUnit($tahun){
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $title = "Daftar Unit";
            $tgl = \Carbon\Carbon::now('GMT+8');

            // BY DEALER
            $sentral = DB::table('stoks')->where([ ['dealer_kode','AA0101'],['tahun',$tahun],['stok','>','0'] ])->get();
            $bmm = DB::table('stoks')->where([ ['dealer_kode','AA0102'],['tahun',$tahun],['stok','>','0'] ])->get();
            $ud = DB::table('stoks')->where([ ['dealer_kode','AA0104'],['tahun',$tahun],['stok','>','0'] ])->get();
            $tts = DB::table('stoks')->where([ ['dealer_kode','AA0105'],['tahun',$tahun],['stok','>','0'] ])->get();
            $imbo = DB::table('stoks')->where([ ['dealer_kode','AA0106'],['tahun',$tahun],['stok','>','0'] ])->get();
            $mandiri = DB::table('stoks')->where([ ['dealer_kode','AA0107'],['tahun',$tahun],['stok','>','0'] ])->get();
            $wr = DB::table('stoks')->where([ ['dealer_kode','AA0108'],['tahun',$tahun],['stok','>','0'] ])->get();
            $sr = DB::table('stoks')->where([ ['dealer_kode','AA0109'],['tahun',$tahun],['stok','>','0'] ])->get();
            $fss = DB::table('stoks')->where([ ['dealer_kode','AA0104F'],['tahun',$tahun],['stok','>','0'] ])->get();

            $aa01 = DB::table('stoks')->where([ ['dealer_kode','AA0101'],['tahun',$tahun], ])->sum('stok');
            $aa02 = DB::table('stoks')->where([ ['dealer_kode','AA0102'],['tahun',$tahun], ])->sum('stok');
            $aa04 = DB::table('stoks')->where([ ['dealer_kode','AA0104'],['tahun',$tahun], ])->sum('stok');
            $aa05 = DB::table('stoks')->where([ ['dealer_kode','AA0105'],['tahun',$tahun], ])->sum('stok');
            $aa06 = DB::table('stoks')->where([ ['dealer_kode','AA0106'],['tahun',$tahun], ])->sum('stok');
            $aa07 = DB::table('stoks')->where([ ['dealer_kode','AA0107'],['tahun',$tahun], ])->sum('stok');
            $aa08 = DB::table('stoks')->where([ ['dealer_kode','AA0108'],['tahun',$tahun], ])->sum('stok');
            $aa09 = DB::table('stoks')->where([ ['dealer_kode','AA0109'],['tahun',$tahun], ])->sum('stok');
            $aa04F = DB::table('stoks')->where([ ['dealer_kode','AA0104F'],['tahun',$tahun] ])->sum('stok');

            $grandtotal = $aa01+$aa02+$aa04+$aa05+$aa06+$aa07+$aa08+$aa09+$aa04F;
            // END BY DEALER

            // BY UNIT
            $data = DB::table('stoks')
            ->where([ ['tahun',$tahun],['stok','>','0'], ])
            ->orderBy('nama_motor','asc')
            ->get();

            $total = DB::table('stoks')
            ->where('tahun',$tahun)
            ->sum('stok');
            // END BY UNIT

            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

            return view('report.unit_list',compact(
                  'tgl','title','now','tahun','data','total','data_user','count_user',
                  'sentral','bmm','ud','tts','imbo','mandiri','wr','sr','fss',
                  'aa01','aa02','aa04','aa05','aa06','aa07','aa08','aa09','aa04F',
                  'grandtotal'
            ));
        }
      }

      public function printUnit($tahun){
            if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $title = "Daftar Unit";
            $tgl = \Carbon\Carbon::now('GMT+8');

            // BY DEALER
            $sentral = DB::table('stoks')->where([ ['dealer_kode','AA0101'],['tahun',$tahun],['stok','>','0'] ])->get();
            $bmm = DB::table('stoks')->where([ ['dealer_kode','AA0102'],['tahun',$tahun],['stok','>','0'] ])->get();
            $ud = DB::table('stoks')->where([ ['dealer_kode','AA0104'],['tahun',$tahun],['stok','>','0'] ])->get();
            $tts = DB::table('stoks')->where([ ['dealer_kode','AA0105'],['tahun',$tahun],['stok','>','0'] ])->get();
            $imbo = DB::table('stoks')->where([ ['dealer_kode','AA0106'],['tahun',$tahun],['stok','>','0'] ])->get();
            $mandiri = DB::table('stoks')->where([ ['dealer_kode','AA0107'],['tahun',$tahun],['stok','>','0'] ])->get();
            $wr = DB::table('stoks')->where([ ['dealer_kode','AA0108'],['tahun',$tahun],['stok','>','0'] ])->get();
            $sr = DB::table('stoks')->where([ ['dealer_kode','AA0109'],['tahun',$tahun],['stok','>','0'] ])->get();
            $fss = DB::table('stoks')->where([ ['dealer_kode','AA0104F'],['tahun',$tahun],['stok','>','0'] ])->get();

            $aa01 = DB::table('stoks')->where([ ['dealer_kode','AA0101'],['tahun',$tahun], ])->sum('stok');
            $aa02 = DB::table('stoks')->where([ ['dealer_kode','AA0102'],['tahun',$tahun], ])->sum('stok');
            $aa04 = DB::table('stoks')->where([ ['dealer_kode','AA0104'],['tahun',$tahun], ])->sum('stok');
            $aa05 = DB::table('stoks')->where([ ['dealer_kode','AA0105'],['tahun',$tahun], ])->sum('stok');
            $aa06 = DB::table('stoks')->where([ ['dealer_kode','AA0106'],['tahun',$tahun], ])->sum('stok');
            $aa07 = DB::table('stoks')->where([ ['dealer_kode','AA0107'],['tahun',$tahun], ])->sum('stok');
            $aa08 = DB::table('stoks')->where([ ['dealer_kode','AA0108'],['tahun',$tahun], ])->sum('stok');
            $aa09 = DB::table('stoks')->where([ ['dealer_kode','AA0109'],['tahun',$tahun], ])->sum('stok');
            $aa04F = DB::table('stoks')->where([ ['dealer_kode','AA0104F'],['tahun',$tahun] ])->sum('stok');

            $grandtotal = $aa01+$aa02+$aa04+$aa05+$aa06+$aa07+$aa08+$aa09+$aa04F;
            // END BY DEALER

            $pdf = PDF::loadview('report.rpt_unit',compact(
                  'tgl','title','tahun','now',
                  'sentral','bmm','ud','tts','imbo','mandiri','wr','sr','fss',
                  'aa01','aa02','aa04','aa05','aa06','aa07','aa08','aa09','aa04F',
                  'grandtotal'
            ));
            
            return $pdf->download('stok_group_'.$tahun.'.pdf');
        }
      }

      public function excelUnit($tahun){
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            return (new UnitExport)->tahun($tahun)->download('Stok_Group_'.$tahun.'.xlsx');
      }

      public function excelPenjualan($awal, $akhir){
            return (new PenjualanExport)->awal($awal)->akhir($akhir)->download('Penjualan_Riil_'.$awal.'-'.$akhir.'.xlsx');
      }

      public function Riil(){
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $awal = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $akhir = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $title = "Penjualan Riil";

            $data = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->orderBy('juals.tanggal_jual','desc')
            ->get();

            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

            return view('report.report_riil',compact('now','title','data','awal','akhir','data_user','count_user'));
      }

      public function RiilCari(Request $req){
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $awal = $req->awal;
            $akhir = $req->akhir;
            $title = "Penjualan Riil";

            $data = DB::table('juals')
            ->join('stoks','juals.stok_id','=','stoks.id_stok')
            ->whereBetween('tanggal_jual',[$awal,$akhir])
            ->orderBy('juals.tanggal_jual','desc')
            ->get();

            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

            return view('report.report_riil_cari',compact('now','title','data','awal','akhir','data_user','count_user'));
      }

    //   Function Buat LAPORAN STOK ==========================
      public function home(){
        $title = "Lapor Stok";
        $dealer = "Bisma Group";
        $home = Session::get('kode_dealer');
        if ($home == "AA0101") {
            $title = "Lapor Stok Bisma Sentral";
            $dealer = "Bisma Sentral";
        }elseif ($home == "AA0102") {
            $title = "Lapor Stok Bisma Cokro";
            $dealer = "Bisma Cokro";
        }elseif ($home == "AA0104") {
            $title = "Lapor Stok Bisma Hasanuddin";
            $dealer = "Bisma Hasanuddin";
        }elseif ($home == "AA0105") {
            $title = "Lapor Stok Bisma TTS";
            $dealer = "Bisma TTS";
        }elseif ($home == "AA0106") {
            $title = "Lapor Stok Bisma Imam Bonjol";
            $dealer = "Bisma Imam Bonjol";
        }elseif ($home == "AA0107") {
            $title = "Lapor Stok Bisma Mandiri";
            $dealer = "Bisma Mandiri";
        }elseif ($home == "AA0108") {
            $title = "Lapor Stok Bisma WR Supratman";
            $dealer = "Bisma WR Supratman";
        }elseif ($home == "AA0109") {
            $title = "Lapor Stok Bisma Sunset Road";
            $dealer = "Bisma Sunset Road";
        }elseif ($home == "AA0104F") {
            $title = "Lapor Stok Flagship Shop";
            $dealer = "Flagship Shop";
        }else{
            $title = "Lapor Stok";
            $dealer = "Bisma Group";
        }

        if (!Session::get('login')) {
            return view('report.home_lapor',compact('title','dealer'));
        }else{
            // Ambil data user login hari ini
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

            return view('report.home_lapor',compact('title','dealer','data_user','count_user','now','home','title','dealer'));
        }
      }

      public function lapor($home){
        if ($home == "AA0101") {
            $title = "Lapor Stok Bisma Sentral";
            $dealer = "Bisma Sentral";
        }elseif ($home == "AA0102") {
            $title = "Lapor Stok Bisma Cokro";
            $dealer = "Bisma Cokro";
        }elseif ($home == "AA0104") {
            $title = "Lapor Stok Bisma Hasanuddin";
            $dealer = "Bisma Hasanuddin";
        }elseif ($home == "AA0105") {
            $title = "Lapor Stok Bisma TTS";
            $dealer = "Bisma TTS";
        }elseif ($home == "AA0106") {
            $title = "Lapor Stok Bisma Imam Bonjol";
            $dealer = "Bisma Imam Bonjol";
        }elseif ($home == "AA0107") {
            $title = "Lapor Stok Bisma Mandiri";
            $dealer = "Bisma Mandiri";
        }elseif ($home == "AA0108") {
            $title = "Lapor Stok Bisma WR Supratman";
            $dealer = "Bisma WR Supratman";
        }elseif ($home == "AA0109") {
            $title = "Lapor Stok Bisma Sunset Road";
            $dealer = "Bisma Sunset Road";
        }elseif ($home == "AA0104F") {
            $title = "Lapor Stok Flagship Shop";
            $dealer = "Flagship Shop";
        }else{
            $title = "Lapor Stok";
            $dealer = "Bisma Group";
        }

        $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
        $warna = DB::table('warnas')->orderBy('warna','asc')->get();
        $stok = DB::table('stoks')->where('dealer_kode',$home)->sum('stok');
        $unit = DB::table('units')->orderBy('nama_unit','asc')->get();
        $tgllapor = DB::table('report_sum')
        ->where('kode_dealer',$home)
        ->orderBy('sum_tanggal','desc')
        ->limit(1)
        ->get();
        // DAFTAR RIWAYAT LAPOR
        $data = DB::table('report_sum')->where('kode_dealer',$home)->orderBy('sum_tanggal','desc')->limit(7)->get();

        if (!Session::get('login')) {
            return view('report.lapor',compact('title','dealer','now','warna','stok','unit','home','tgllapor','data'));
        }else{
            $tgl = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            // Ambil data user login hari ini
            $data_user = DB::table('users')
            ->where('login', 'like', $tgl.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $tgl.'%')
            ->count();

            return view('report.lapor',compact('title','dealer','now','warna','stok','unit','home','data_user','count_user','tgllapor','data'));
        }
      }

      public function Clapor(Request $req){
        $home = $req->kode_dealer;

        // cek apakah tanggal lapor sudah ada?
        $cek = DB::table('report_sum')->where([
            ['sum_tanggal',$req->tanggal_report],
            ['kode_dealer',$home],
        ])->count();

        if ($cek > 0){
            alert()->warning('Peringatan','Tanggal lapor sudah ada!');
            return redirect()->back();
        }else{
            $tgl = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
                // foreach ($req->in_stok as $key => $value) {
                //     DB::table('report_in')->insert([
                //         'kode_dealer' => $req->kode_dealer,
                //         'in_tanggal' => $req->tanggal_report,
                //         'pemasok' => $req->pemasok[$key],
                //         'in_qty' => $req->in_stok[$key],
                //         'in_unit' => $req->in_unit[$key],
                //         'in_warna' => $req->in_warna[$key],
                //         'in_tahun' => $req->in_tahun[$key],
                //     ]);
                // }
            
            $in_stok = $req->in_stok;
            $out_stok = $req->out_stok;
            $sale_stok = $req->sale_stok;
            
            $total_in = 0;
            $total_out = 0;
            $total_sale = 0;

            if (($in_stok == "") AND ($out_stok == "") AND ($sale_stok == "")) {
                // Jika tidak ada stok masuk, keluar dan laku
                // Insert Stok Awal
                DB::table('report_stok_awal')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sa_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Faktur Service
                DB::table('report_fs')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'fs_tanggal' => $req->tanggal_report,
                    'faktur' => $req->faktur,
                    'service' => $req->service,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Stok Akhir
                DB::table('report_stok_akhir')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sak_tanggal' => $req->tanggal_report,
                    'stok_akhir' => $req->stok_awal,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Report Summary
                DB::table('report_sum')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sum_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'sum_instok' => 0,
                    'sum_outstok' => 0,
                    'sum_salestok' => 0,
                    'stok_akhir' => $req->stok_awal,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);

            }elseif (($in_stok == "") AND ($out_stok == "")) {

                // Jika tidak ada stok masuk dan stok keluar
                // Insert Stok Awal
                DB::table('report_stok_awal')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sa_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Stok Laku
                for ($i=0; $i < count($req->sale_stok); $i++) { 
                    $total_sale = $total_sale + $req->sale_stok[$i];

                    DB::table('report_sale')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sale_tanggal' => $req->tanggal_report,
                    'sale_qty' => $req->sale_stok[$i],
                    'sale_unit' => $req->sale_unit[$i],
                    'sale_warna' => $req->sale_warna[$i],
                    'sale_tahun' => $req->sale_tahun[$i],
                    'leasing' => $req->leasing[$i],
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                    ]);
                }

                $stok_akhir = $req->stok_awal - $total_sale;
                
                // Insert Faktur Service
                DB::table('report_fs')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'fs_tanggal' => $req->tanggal_report,
                    'faktur' => $req->faktur,
                    'service' => $req->service,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);

                // Insert Stok Akhir
                DB::table('report_stok_akhir')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sak_tanggal' => $req->tanggal_report,
                    'stok_akhir' => $stok_akhir,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Report Summary
                DB::table('report_sum')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sum_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'sum_instok' => 0,
                    'sum_outstok' => 0,
                    'sum_salestok' => $total_sale,
                    'stok_akhir' => $stok_akhir,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);

            }elseif (($out_stok != "") AND ($sale_stok != "") AND ($in_stok == "")) {

                // Jika tidak ada stok masuk
                // Insert Stok Awal
                DB::table('report_stok_awal')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sa_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Stok Keluar
                for ($i=0; $i < count($req->out_stok); $i++) { 
                    $total_out = $total_out + $req->out_stok[$i];

                    DB::table('report_out')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'out_tanggal' => $req->tanggal_report,
                    'cabang' => $req->cabang[$i],
                    'out_qty' => $req->out_stok[$i],
                    'out_unit' => $req->out_unit[$i],
                    'out_warna' => $req->out_warna[$i],
                    'out_tahun' => $req->out_tahun[$i],
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                    ]);
                }
                // Insert Stok Laku
                for ($i=0; $i < count($req->sale_stok); $i++) { 
                    $total_sale = $total_sale + $req->sale_stok[$i];

                    DB::table('report_sale')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sale_tanggal' => $req->tanggal_report,
                    'sale_qty' => $req->sale_stok[$i],
                    'sale_unit' => $req->sale_unit[$i],
                    'sale_warna' => $req->sale_warna[$i],
                    'sale_tahun' => $req->sale_tahun[$i],
                    'leasing' => $req->leasing[$i],
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                    ]);
                }

                $out_sale = $total_out + $total_sale;
                $stok_akhir = $req->stok_awal - $out_sale;

                // Insert Faktur Service
                DB::table('report_fs')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'fs_tanggal' => $req->tanggal_report,
                    'faktur' => $req->faktur,
                    'service' => $req->service,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);

                // Insert Stok Akhir
                DB::table('report_stok_akhir')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sak_tanggal' => $req->tanggal_report,
                    'stok_akhir' => $stok_akhir,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Report Summary
                DB::table('report_sum')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sum_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'sum_instok' => 0,
                    'sum_outstok' => $total_out,
                    'sum_salestok' => $total_sale,
                    'stok_akhir' => $stok_akhir,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);

            }elseif (($out_stok == "") AND ($sale_stok == "")) {

                // Jika tidak ada stok keluar dan laku
                // Insert Stok Awal
                DB::table('report_stok_awal')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sa_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Stok Masuk
                for ($i=0; $i < count($req->in_stok); $i++) { 
                    $total_in = $total_in + $req->in_stok[$i];

                    DB::table('report_in')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'in_tanggal' => $req->tanggal_report,
                    'pemasok' => $req->pemasok[$i],
                    'in_qty' => $req->in_stok[$i],
                    'in_unit' => $req->in_unit[$i],
                    'in_warna' => $req->in_warna[$i],
                    'in_tahun' => $req->in_tahun[$i],
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                    ]);
                }
                $stok_akhir = $req->stok_awal + $total_in;

                // Insert Faktur Service
                DB::table('report_fs')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'fs_tanggal' => $req->tanggal_report,
                    'faktur' => $req->faktur,
                    'service' => $req->service,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);

                // Insert Stok Akhir
                DB::table('report_stok_akhir')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sak_tanggal' => $req->tanggal_report,
                    'stok_akhir' => $stok_akhir,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Report Summary
                DB::table('report_sum')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sum_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'sum_instok' => $total_in,
                    'sum_outstok' => 0,
                    'sum_salestok' => 0,
                    'stok_akhir' => $stok_akhir,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);

            }elseif (($in_stok != "") AND ($sale_stok != "") AND ($out_stok == "")) {

                // Jika tidak ada stok keluar
                // Insert Stok Awal
                DB::table('report_stok_awal')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sa_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Stok Masuk
                for ($i=0; $i < count($req->in_stok); $i++) { 
                    $total_in = $total_in + $req->in_stok[$i];

                    DB::table('report_in')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'in_tanggal' => $req->tanggal_report,
                    'pemasok' => $req->pemasok[$i],
                    'in_qty' => $req->in_stok[$i],
                    'in_unit' => $req->in_unit[$i],
                    'in_warna' => $req->in_warna[$i],
                    'in_tahun' => $req->in_tahun[$i],
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                    ]);
                }
                // Insert Stok Laku
                for ($i=0; $i < count($req->sale_stok); $i++) { 
                    $total_sale = $total_sale + $req->sale_stok[$i];

                    DB::table('report_sale')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sale_tanggal' => $req->tanggal_report,
                    'sale_qty' => $req->sale_stok[$i],
                    'sale_unit' => $req->sale_unit[$i],
                    'sale_warna' => $req->sale_warna[$i],
                    'sale_tahun' => $req->sale_tahun[$i],
                    'leasing' => $req->leasing[$i],
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                    ]);
                }
                $in = $req->stok_awal + $total_in;
                $stok_akhir = $in - $total_sale;
                
                // Insert Faktur Service
                DB::table('report_fs')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'fs_tanggal' => $req->tanggal_report,
                    'faktur' => $req->faktur,
                    'service' => $req->service,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Stok Akhir
                DB::table('report_stok_akhir')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sak_tanggal' => $req->tanggal_report,
                    'stok_akhir' => $stok_akhir,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Report Summary
                DB::table('report_sum')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sum_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'sum_instok' => $total_in,
                    'sum_outstok' => 0,
                    'sum_salestok' => $total_sale,
                    'stok_akhir' => $stok_akhir,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);

            }elseif (($in_stok != "") AND ($out_stok != "") AND ($sale_stok == "")) {

                // Jika tidak ada stok laku
                // Insert Stok Awal
                DB::table('report_stok_awal')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sa_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);

                // Insert Stok Masuk
                for ($i=0; $i < count($req->in_stok); $i++) { 
                    $total_in = $total_in + $req->in_stok[$i];

                    DB::table('report_in')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'in_tanggal' => $req->tanggal_report,
                    'pemasok' => $req->pemasok[$i],
                    'in_qty' => $req->in_stok[$i],
                    'in_unit' => $req->in_unit[$i],
                    'in_warna' => $req->in_warna[$i],
                    'in_tahun' => $req->in_tahun[$i],
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                    ]);
                }
                // Insert Stok Keluar
                for ($i=0; $i < count($req->out_stok); $i++) { 
                    $total_out = $total_out + $req->out_stok[$i];

                    DB::table('report_out')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'out_tanggal' => $req->tanggal_report,
                    'cabang' => $req->cabang[$i],
                    'out_qty' => $req->out_stok[$i],
                    'out_unit' => $req->out_unit[$i],
                    'out_warna' => $req->out_warna[$i],
                    'out_tahun' => $req->out_tahun[$i],
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                    ]);
                }
                $in = $req->stok_awal + $total_in;
                $stok_akhir = $in - $total_out;
                // Insert Faktur Service
                DB::table('report_fs')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'fs_tanggal' => $req->tanggal_report,
                    'faktur' => $req->faktur,
                    'service' => $req->service,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Stok Akhir
                DB::table('report_stok_akhir')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sak_tanggal' => $req->tanggal_report,
                    'stok_akhir' => $stok_akhir,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Report Summary
                DB::table('report_sum')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sum_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'sum_instok' => $total_in,
                    'sum_outstok' => $total_out,
                    'sum_salestok' => 0,
                    'stok_akhir' => $stok_akhir,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);

            }elseif(($in_stok == "") AND ($sale_stok == "")){
                // Jika tidak ada stok masuk dan laku
                // Insert Stok Awal
                DB::table('report_stok_awal')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sa_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);

                // Insert Stok Keluar
                for ($i=0; $i < count($req->out_stok); $i++) { 
                    $total_out = $total_out + $req->out_stok[$i];

                    DB::table('report_out')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'out_tanggal' => $req->tanggal_report,
                    'cabang' => $req->cabang[$i],
                    'out_qty' => $req->out_stok[$i],
                    'out_unit' => $req->out_unit[$i],
                    'out_warna' => $req->out_warna[$i],
                    'out_tahun' => $req->out_tahun[$i],
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                    ]);
                }
                $stok_akhir = $req->stok_awal - $total_out;

                // Insert Faktur Service
                DB::table('report_fs')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'fs_tanggal' => $req->tanggal_report,
                    'faktur' => $req->faktur,
                    'service' => $req->service,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Stok Akhir
                DB::table('report_stok_akhir')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sak_tanggal' => $req->tanggal_report,
                    'stok_akhir' => $stok_akhir,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Report Summary
                DB::table('report_sum')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sum_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'sum_instok' => 0,
                    'sum_outstok' => $total_out,
                    'sum_salestok' => 0,
                    'stok_akhir' => $stok_akhir,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);

            }else{

                // Insert Stok Awal
                DB::table('report_stok_awal')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sa_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);

                // Insert Stok Masuk
                for ($i=0; $i < count($req->in_stok); $i++) { 
                    $total_in = $total_in + $req->in_stok[$i];

                    DB::table('report_in')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'in_tanggal' => $req->tanggal_report,
                    'pemasok' => $req->pemasok[$i],
                    'in_qty' => $req->in_stok[$i],
                    'in_unit' => $req->in_unit[$i],
                    'in_warna' => $req->in_warna[$i],
                    'in_tahun' => $req->in_tahun[$i],
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                    ]);
                }
                // Insert Stok Keluar
                for ($i=0; $i < count($req->out_stok); $i++) { 
                    $total_out = $total_out + $req->out_stok[$i];

                    DB::table('report_out')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'out_tanggal' => $req->tanggal_report,
                    'cabang' => $req->cabang[$i],
                    'out_qty' => $req->out_stok[$i],
                    'out_unit' => $req->out_unit[$i],
                    'out_warna' => $req->out_warna[$i],
                    'out_tahun' => $req->out_tahun[$i],
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                    ]);
                }
                // Insert Stok Laku
                for ($i=0; $i < count($req->sale_stok); $i++) { 
                    $total_sale = $total_sale + $req->sale_stok[$i];

                    DB::table('report_sale')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sale_tanggal' => $req->tanggal_report,
                    'sale_qty' => $req->sale_stok[$i],
                    'sale_unit' => $req->sale_unit[$i],
                    'sale_warna' => $req->sale_warna[$i],
                    'sale_tahun' => $req->sale_tahun[$i],
                    'leasing' => $req->leasing[$i],
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                    ]);
                }
                $in = $req->stok_awal + $total_in;
                $out = $in - $total_out;
                $stok_akhir = $out - $total_sale;
                // Insert Faktur Service
                DB::table('report_fs')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'fs_tanggal' => $req->tanggal_report,
                    'faktur' => $req->faktur,
                    'service' => $req->service,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Stok Akhir
                DB::table('report_stok_akhir')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sak_tanggal' => $req->tanggal_report,
                    'stok_akhir' => $stok_akhir,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
                // Insert Report Summary
                DB::table('report_sum')->insert([
                    'kode_dealer' => $req->kode_dealer,
                    'sum_tanggal' => $req->tanggal_report,
                    'stok_awal' => $req->stok_awal,
                    'sum_instok' => $total_in,
                    'sum_outstok' => $total_out,
                    'sum_salestok' => $total_sale,
                    'stok_akhir' => $stok_akhir,
                    'created_at' => \Carbon\Carbon::now('GMT+8'),
                ]);
            } //End if Insert

            toast('Laporan berhasil dibuat','success');
            return redirect('/lapor/riwayat/'.$home.'/'.$req->tanggal_report.'');
        } //End if Cek
        
      }

      public function riwayat($home, $tgl){
        if ($home == "AA0101") {
            $title = "Riwayat Laporan Bisma Sentral";
            $dealer = "Bisma Sentral";
        }elseif ($home == "AA0102") {
            $title = "Riwayat Laporan Bisma Cokro";
            $dealer = "Bisma Cokro";
        }elseif ($home == "AA0104") {
            $title = "Riwayat Laporan Bisma Hasanuddin";
            $dealer = "Bisma Hasanuddin";
        }elseif ($home == "AA0105") {
            $title = "Riwayat Laporan Bisma TTS";
            $dealer = "Bisma TTS";
        }elseif ($home == "AA0106") {
            $title = "Riwayat Laporan Bisma Imam Bonjol";
            $dealer = "Bisma Imam Bonjol";
        }elseif ($home == "AA0107") {
            $title = "Riwayat Laporan Bisma Mandiri";
            $dealer = "Bisma Mandiri";
        }elseif ($home == "AA0108") {
            $title = "Riwayat Laporan Bisma WR Supratman";
            $dealer = "Bisma WR Supratman";
        }elseif ($home == "AA0109") {
            $title = "Riwayat Laporan Bisma Sunset Road";
            $dealer = "Bisma Sunset Road";
        }elseif ($home == "AA0104F") {
            $title = "Riwayat Laporan Flagship Shop";
            $dealer = "Flagship Shop";
        }else{
            $title = "Riwayat Laporan";
            $dealer = "Bisma Group";
        }

        $sa = DB::table('report_stok_awal')->where([
            ['kode_dealer','=',$home],
            ['sa_tanggal','=',$tgl],
        ])->sum('stok_awal');

        // STOK MASUK YIMM
        $sum_yimm = DB::table('report_in')->where([
            ['kode_dealer','=',$home],
            ['in_tanggal','=',$tgl],
            ['pemasok','=','YIMM'],
        ])->sum('in_qty');

        $yimm = DB::table('report_in')->where([
            ['kode_dealer','=',$home],
            ['in_tanggal','=',$tgl],
            ['pemasok','=','YIMM'],
        ])->get();

        // STOK MASUK CABANG
        $sum_cabang = DB::table('report_in')->where([
            ['kode_dealer','=',$home],
            ['in_tanggal','=',$tgl],
            ['pemasok','!=','YIMM'],
        ])->sum('in_qty');

        $cabang = DB::table('report_in')->where([
            ['kode_dealer','=',$home],
            ['in_tanggal','=',$tgl],
            ['pemasok','!=','YIMM'],
        ])->get();

        // STOK KELUAR
        $sum_keluar = DB::table('report_out')->where([
            ['kode_dealer','=',$home],
            ['out_tanggal','=',$tgl],
        ])->sum('out_qty');

        $keluar = DB::table('report_out')->where([
            ['kode_dealer','=',$home],
            ['out_tanggal','=',$tgl],
        ])->get();

        // STOK LAKU
        $sum_laku = DB::table('report_sale')->where([
            ['kode_dealer','=',$home],
            ['sale_tanggal','=',$tgl],
        ])->sum('sale_qty');

        $laku = DB::table('report_sale')->where([
            ['kode_dealer','=',$home],
            ['sale_tanggal','=',$tgl],
        ])->get();

        // FAKTUR SERVICE
        $fs = DB::table('report_fs')->where([
            ['kode_dealer','=',$home],
            ['fs_tanggal','=',$tgl],
        ])->get();

        // STOK AKHIR
        $sak = DB::table('report_stok_akhir')->where([
            ['kode_dealer','=',$home],
            ['sak_tanggal','=',$tgl],
        ])->sum('stok_akhir');

        // DAFTAR RIWAYAT LAPOR
        $data = DB::table('report_sum')->where('kode_dealer',$home)->orderBy('sum_tanggal','desc')->limit(7)->get();

        if (!Session::get('login')) {
            return view('report.riwayat_lapor',compact('title','dealer','tgl','sa','yimm','cabang','keluar','laku','fs','sak','sum_yimm','sum_cabang','sum_keluar','sum_laku','data','home','now','data_user','count_user'));
        }else{
            // Ambil data user login hari ini
            $now = \Carbon\Carbon::now('GMT+8')->format('Y-m-d');
            $data_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->get();

            // Hitung user login hari ini
            $count_user = DB::table('users')
            ->where('login', 'like', $now.'%')
            ->count();

            return view('report.riwayat_lapor',compact('title','dealer','tgl','sa','yimm','cabang','keluar','laku','fs','sak','sum_yimm','sum_cabang','sum_keluar','sum_laku','data','home','now','data_user','count_user'));
        }
      }
    
    public function Dlapor($home, $tgl){
        if (!Session::get('login')) {
            alert('Login Gagal!','Anda harus login!', 'warning')->persistent('OK');
            return redirect('/');
        }else{
            DB::table('report_fs')->where([
                ['kode_dealer','=',$home],
                ['fs_tanggal','=',$tgl],
            ])->delete();

            DB::table('report_in')->where([
                ['kode_dealer','=',$home],
                ['in_tanggal','=',$tgl],
            ])->delete();

            DB::table('report_out')->where([
                ['kode_dealer','=',$home],
                ['out_tanggal','=',$tgl],
            ])->delete();

            DB::table('report_sale')->where([
                ['kode_dealer','=',$home],
                ['sale_tanggal','=',$tgl],
            ])->delete();

            DB::table('report_stok_akhir')->where([
                ['kode_dealer','=',$home],
                ['sak_tanggal','=',$tgl],
            ])->delete();

            DB::table('report_stok_awal')->where([
                ['kode_dealer','=',$home],
                ['sa_tanggal','=',$tgl],
            ])->delete();

            DB::table('report_sum')->where([
                ['kode_dealer','=',$home],
                ['sum_tanggal','=',$tgl],
            ])->delete();

            toast('Data berhasil di hapus','success');
            return redirect()->back();
        }
    }
}