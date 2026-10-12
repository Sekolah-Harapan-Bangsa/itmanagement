<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommodityLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            'Ruang Guru',
            'Ruang Kepala Sekolah SMP',
            'Ruang Kepala Sekolah SMA',
            'Ruang Staff Tata Usaha',
            'Ruang Kepala Tata Usaha',
            'Ruang BP/BK',
            'Ruang Gudang',
            'Ruang Perpustakaan',
            'Ruang OSIS',
            'Ruang Laboratorium Fisika',
            'Ruang Laboratorium Kimia',
            'Ruang Laboratorium Biology',
            'Ruang Mandarin',
            'Ruang Komputer',
            'Ruang Praktek',
            'Ruang Serba Guna',
            'Ruang UKS',
            'Ruang Kantin',
            'Ruang Koperasi',
            'Ruang Satpam',
            'Ruang Seni Musik',
            'Ruang Kegiatan Ekstrakurikuler',
            'Ruang Admission',
            'Ruang Fotocopy',
            'Ruang General Affairs',
            'Ruang Kasir',
            'Ruang Bookstore',
            'Ruang Ibadah Islam',
            'Ruang Ibadah Kristen',
            'Ruang Ibadah Katolik',
            'Ruang Ibadah Hindu',
            'Ruang Ibadah Buddha',
            'Ruang Ibadah Konghucu'
        ];

        for ($i = 1; $i < count($locations); $i++) {
            DB::table('commodity_locations')->insert([
                'name' => $locations[$i],
                'description' => 'Ruangan '.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i = 1; $i < 10; $i++) {
            DB::table('commodity_locations')->insert([
                'name' => 'Kelas '.$i,
                'description' => 'Ruangan Kelas '.$i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
