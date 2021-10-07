<?php

namespace App\Exports;

use App\Stok;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UnitExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function tahun(string $tahun)
    {
        $this->tahun = $tahun;
        
        return $this;
    }

    public function query()
    {
        return Stok::query()
        ->select('dealer_kode','nama_motor','warna','jenis','stok','tahun')
        ->where([ ['tahun',$this->tahun],['stok','>','0'], ])
        ->orderBy('dealer_kode','asc');
    }

    public function headings(): array
    {
        return [
        	'Kode Dealer',
            'Unit',
            'Warna',
            'Jenis',
            'Stok',
            'Tahun',
        ];
    }
}
