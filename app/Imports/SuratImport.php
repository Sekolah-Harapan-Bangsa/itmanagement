<?php

namespace App\Imports;

use App\Surat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SuratImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Surat([
            'nomor_surat' => $row['nomor_surat'],
            'nama' => $row['nama'],
            'tanggal' => $row['tanggal'],
            'keterangan' => $row['keterangan'],
        ]);
    }
}