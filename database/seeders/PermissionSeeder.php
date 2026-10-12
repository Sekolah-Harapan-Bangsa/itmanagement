<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Jalankan database seeder.
     */
    public function run(): void
    {
        // Daftar menu utama
        $menuNames = collect([
            'barang',
            'perolehan',
            'ruangan',
            'pengguna',
            'surat',
            'task', // Tambahkan task di sini
        ]);

        // Permission default (CRUD + detail)
        $permissionNames = ['tambah', 'lihat', 'detail', 'ubah', 'hapus'];

        // Generate permission default otomatis
        $basePermissions = $menuNames->flatMap(fn($menu) => collect($permissionNames)->map(fn($action) => "$action $menu"));

        // Permission khusus/manual
        $customPermissions = collect([
            // Barang
            'import barang',
            'export barang',
            'print barang',
            'print individual barang',

            // Ruangan
            'import ruangan',
            'export ruangan',

            // Profile
            'mengatur profile',

            // Peran dan Hak Akses
            'lihat peran dan hak akses',
            'tambah peran dan hak akses',
            'ubah peran dan hak akses',
            'hapus peran dan hak akses',

            // Task
            'print task',
            'export task',
        ]);

        // Gabungkan semua permission, hilangkan duplikasi
        $allPermissions = $basePermissions->merge($customPermissions)->unique();

        // Simpan ke database jika belum ada
        foreach ($allPermissions as $perm) {
            Permission::firstOrCreate(
                ['name' => $perm, 'guard_name' => 'web'],
                ['created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
