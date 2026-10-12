<?php

namespace App\Exports;

use App\Surat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SuratExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Surat::select('nomor_surat', 'nama', 'tanggal', 'keterangan', 'created_at', 'updated_at')->get();
    }

    public function headings(): array
    {
        return [
            'Nomor Surat',
            'Nama',
            'Tanggal',
            'Keterangan',
            'Dibuat Pada',
            'Diperbarui Pada',
        ];
    }
}