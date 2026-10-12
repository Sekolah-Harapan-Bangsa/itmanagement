<?php

namespace App\Imports;

use App\Task;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TaskImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Jika item kosong → lewati baris
        if (!isset($row['item']) || empty($row['item'])) {
            return null;
        }

        // Konversi deadline Excel ke format tanggal Y-m-d
        $deadline = null;
        if (!empty($row['deadline'])) {
            if (is_numeric($row['deadline'])) {
                // Jika format angka → konversi dari serial Excel
                $deadline = Carbon::instance(Date::excelToDateTimeObject($row['deadline']))->format('Y-m-d');
            } else {
                // Jika sudah format tanggal → gunakan langsung
                $deadline = Carbon::parse($row['deadline'])->format('Y-m-d');
            }
        }

        return new Task([
            'item'       => $row['item'] ?? null,
            'jenis'      => $row['jenis'] ?? null,
            'vendor_pic' => $row['vendor_pic'] ?? null,
            'deadline'   => $deadline,
            'keterangan' => $row['keterangan'] ?? null,
        ]);
    }
}
