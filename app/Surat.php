<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'nomor_surat', 'nama', 'foto', 'tanggal', 'keterangan'
    ];
}
