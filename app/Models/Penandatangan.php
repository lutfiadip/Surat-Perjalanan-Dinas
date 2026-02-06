<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penandatangan extends Model
{
    use HasFactory;

    protected $table = 'penandatangan';

    protected $fillable = [
        'nama',
        'pangkat',
        'nip',
        'jabatan',
        'jenis',
        'variant_ttd',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];
}
