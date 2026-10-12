<?php

namespace App\Policies;

use App\User; // atau sesuai namespace User kamu

class SuratPolicy
{
    /**
     * Determine whether the user can view any surat.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('lihat surat');
    }

    /**
     * Determine whether the user can view the surat.
     */
    public function view(User $user, Surat $surat): bool
    {
        return $user->can('lihat surat');
    }

    /**
     * Determine whether the user can create surat.
     */
    public function create(User $user): bool
    {
        return $user->can('tambah surat');
    }

    /**
     * Determine whether the user can update the surat.
     */
    public function update(User $user, Surat $surat): bool
    {
        return $user->can('ubah surat');
    }

    /**
     * Determine whether the user can delete the surat.
     */
    public function delete(User $user, Surat $surat): bool
    {
        return $user->can('hapus surat');
    }

    /**
     * Restore / forceDelete tidak digunakan saat ini.
     */
    public function restore(User $user, Surat $surat): bool
    {
        return false;
    }

    public function forceDelete(User $user, Surat $surat): bool
    {
        return false;
    }
}
