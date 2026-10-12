<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{
    protected $fillable = [
        'item', 'jenis', 'vendor_pic', 'deadline', 'sisa_hari', 'status', 'keterangan'
    ];

    protected $dates = ['deadline'];

    // Hitung sisa hari otomatis
    public function getSisaHariAttribute()
    {
        return Carbon::now()->diffInDays($this->deadline, false);
    }

    // Status otomatis berdasarkan deadline
    public function getStatusAttribute()
    {
        if ($this->sisa_hari < 0) {
            return 'Kadaluarsa ❌';
        } elseif ($this->sisa_hari <= 30) {
            return 'H-30 🔔';
        }
        return 'Aktif ✅';
    }
}
