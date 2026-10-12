<?php

namespace App\Imports;

use App\Commodity;
use App\CommodityAcquisition;
use App\CommodityLocation;
use App\Unit;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class CommoditiesImport implements
    ToModel,
    WithHeadingRow,
    WithUpserts,
    WithCalculatedFormulas
{
    protected array $errors = [];

    public function model(array $row)
    {
        try {
            if (
                empty($row['nama_barang']) ||
                empty($row['kode_barang'])
            ) {
                throw new \Exception(
                    'Nama Barang atau Kode Barang kosong'
                );
            }

            /*
             * UNIT
             *
             * Excel bisa berisi:
             * SHB1
             * SHB2
             * SHB 1
             * SHB 2
             *
             * Pencarian dilakukan berdasarkan
             * code ATAU name.
             */
            $unit = null;

            if (!empty($row['unit'])) {
                $unitValue = trim((string) $row['unit']);

                $unit = Unit::where('code', $unitValue)
                    ->orWhere('name', $unitValue)
                    ->first();

                if (!$unit) {
                    throw new \Exception(
                        "Unit '{$unitValue}' tidak ditemukan"
                    );
                }
            }

            /*
             * LOKASI
             */
            $commodityLocation = null;

            if (!empty($row['lokasi'])) {
                $lokasiValue = trim((string) $row['lokasi']);

                $commodityLocation = CommodityLocation::where(
                    'name',
                    $lokasiValue
                )->first();

                if (!$commodityLocation) {
                    throw new \Exception(
                        "Lokasi '{$lokasiValue}' tidak ditemukan"
                    );
                }
            }

            /*
             * ASAL PEROLEHAN
             */
            $commodityAcquisition = null;

            if (!empty($row['asal_perolehan'])) {
                $asalPerolehanValue =
                    trim((string) $row['asal_perolehan']);

                $commodityAcquisition =
                    CommodityAcquisition::where(
                        'name',
                        $asalPerolehanValue
                    )->first();

                if (!$commodityAcquisition) {
                    throw new \Exception(
                        "Asal perolehan '{$asalPerolehanValue}' tidak ditemukan"
                    );
                }
            }

            /*
             * SIMPAN COMMODITY
             */
            return new Commodity([
                'item_code' => trim(
                    (string) $row['kode_barang']
                ),

                'name' => trim(
                    (string) $row['nama_barang']
                ),

                'brand' => !empty($row['merek'])
                    ? trim((string) $row['merek'])
                    : null,

                'material' => !empty($row['bahan'])
                    ? trim((string) $row['bahan'])
                    : null,

                'unit_id' => optional($unit)->id,

                'commodity_acquisition_id' =>
                    optional($commodityAcquisition)->id,

                'commodity_location_id' =>
                    optional($commodityLocation)->id,

                'year_of_purchase' =>
                    $row['tahun_pembelian'] ?? null,

                'condition' =>
                    $this->translateConditionNameToNumber(
                        $row['kondisi'] ?? null
                    ),

                'quantity' =>
                    $row['kuantitas'] ?? 0,

                'price' =>
                    $row['harga'] ?? 0,

                'price_per_item' =>
                    $row['harga_satuan'] ?? 0,

                'note' => !empty($row['keterangan'])
                    ? trim((string) $row['keterangan'])
                    : null,
            ]);

        } catch (\Throwable $e) {
            $this->errors[] = [
                'row' => $row,
                'reason' => $e->getMessage(),
            ];

            return null;
        }
    }

    /**
     * Kondisi:
     * 1 = Baik
     * 2 = Kurang Baik
     * 3 = Rusak Berat
     */
    public function translateConditionNameToNumber($conditionName)
    {
        if ($conditionName === null) {
            return null;
        }

        return match (trim((string) $conditionName)) {
            'Baik' => 1,
            'Kurang Baik' => 2,
            'Rusak Berat' => 3,
            default => null,
        };
    }

    public function uniqueBy()
    {
        return 'item_code';
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
