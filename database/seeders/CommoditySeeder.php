<?php

namespace Database\Seeders;

use App\CommodityLocation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommoditySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carbon = new Carbon;

        $commodity_locations = CommodityLocation::all();

        $commodities = [
            'Infocus',
            'Kabel VGA',
            'Kabel HDMI',
            'Remote Infocus',
            'Speaker Multimedia',
            'Laptop',
            'PC Desktop',
            'Monitor LED',
            'Keyboard USB',
            'Mouse Wireless',
            'Mouse USB',
            'Printer Laser',
            'Printer Inkjet',
            'Scanner',
            'Proyektor',
            'Switch Hub',
            'Router WiFi',
            'Access Point',
            'Harddisk Eksternal',
            'Flashdisk',
            'Kabel LAN',
            'Stabilizer',
            'UPS',
            'Webcam',
            'Headset',
            'Microphone',
            'Smart TV',
            'TV Box Android',
            'Kabel Power',
            'Converter HDMI to VGA'
        ];


        $brands = [
            'Logitech',
            'Asus',
            'Acer',
            'HP',
            'Dell',
            'Lenovo',
            'Microsoft',
            'Apple',
            'Samsung',
            'LG',
            'Canon',
            'Epson',
            'Brother',
            'TP-Link',
            'D-Link',
            'Cisco',
            'UniFi',
            'Western Digital',
            'Seagate',
            'Kingston',
            'Intel',
            'Gigabyte',
            'SPC',
            'Eyota',
            'V-Gen'
        ];


        $materials = [
            'Plastik ABS',
            'Aluminium',
            'Tembaga',
            'PVC',
            'Karet Silikon',
            'Kaca',
            'FR4',
            'Besi',
            'Polycarbonate',
            'Timah'
        ];


        for ($i = 1; $i <= count($commodities); $i++) {
            DB::table('commodities')->insert([
                'commodity_acquisition_id' => mt_rand(1, 2),
                'commodity_location_id' => mt_rand(1, count($commodity_locations)),
                'item_code' => 'BRGSHB4-'.mt_rand(1000, 9000).mt_rand(100, 900),
                'name' => $commodities[array_rand($commodities)],
                'brand' => $brands[array_rand($brands)],
                'material' => $materials[array_rand($materials)],
                'year_of_purchase' => mt_rand(2010, date('Y')),
                'condition' => mt_rand(1, 3),
                'quantity' => mt_rand(50, 200),
                'price' => mt_rand(5000, 500000),
                'price_per_item' => mt_rand(2500, 150000),
                'note' => 'Keterangan barang',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
