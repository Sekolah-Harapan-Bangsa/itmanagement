<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Unit;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            [
                'code' => 'SHB1',
                'name' => 'SHB 1',
            ],
            [
                'code' => 'SHB2',
                'name' => 'SHB 2',
            ],
            [
                'code' => 'SHB3',
                'name' => 'SHB 3',
            ],
            [
                'code' => 'SHB4',
                'name' => 'SHB 4',
            ],
            [
                'code' => 'SHB5',
                'name' => 'SHB 5',
            ],
        ];

        foreach ($units as $unit) {
            Unit::updateOrCreate(
                ['code' => $unit['code']],
                $unit
            );
        }
    }
}