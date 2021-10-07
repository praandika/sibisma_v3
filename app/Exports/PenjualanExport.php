<?php

namespace App\Exports;

use App\Jual;
use App\Stok;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PenjualanExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function awal(string $awal)
    {
        $this->awal = $awal;
        
        return $this;
    }

    public function akhir(string $akhir)
    {
        $this->akhir = $akhir;
        
        return $this;
    }

    public function query()
    {
        return Jual::query()
        ->select('juals.dealer_kode','juals.id_jual','juals.tanggal_jual','stoks.nama_motor','juals.qty','juals.leasing')
        ->join('stoks','juals.stok_id','=','stoks.id_stok')
        ->whereBetween('juals.tanggal_jual', [$this->awal,$this->akhir])
        ->orderBy('juals.tanggal_jual','asc');
    }

    public function headings(): array
    {
        return [
            'Kode Dealer',
            'Id Jual',
            'Tanggal Jual',
            'Nama Motor',
            'Qty',
            'Leasing'
        ];
    }
}
