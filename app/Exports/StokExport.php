<?php

namespace App\Exports;

use App\Stok;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StokExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function dealer(string $kode)
    {
        $this->kode = $kode;
        
        return $this;
    }

    public function query()
    {
        return Stok::query()->select('nama_motor','warna','jenis','stok','tahun','dealer_kode')->where('dealer_kode', $this->kode);
    }

    public function headings(): array
    {
        return [
            'Unit',
            'Warna',
            'Jenis',
            'Stok',
            'Tahun',
            'Kode Dealer'
        ];
    }
}
