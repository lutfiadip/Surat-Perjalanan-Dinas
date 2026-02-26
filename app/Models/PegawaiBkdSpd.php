<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiBkdSpd extends Model
{
    use HasFactory;

    protected $table = 'pegawaibkd_spd';

    protected $fillable = [
        'nama',
        'pangkat_gol',
        'nip',
        'jabatan',
        'unit_kerja',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];

    // Disable timestamps if the table doesn't have them, usually legacy tables don't
    public $timestamps = false;

    public function spds()
    {
        return $this->belongsToMany(Spd::class, 'spd_pegawai', 'pegawai_id', 'spd_id');
    }
}
