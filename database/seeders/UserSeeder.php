<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@shb.sch.id',
            'password' => bcrypt('admin@shb.sch.id'),
        ]);

        User::create([
            'name' => 'Staff TU (Tata Usaha)',
            'email' => 'stafftu@shb.sch.id',
            'password' => bcrypt('stafftu@shb.sch.id'),
        ]);
    }
}
