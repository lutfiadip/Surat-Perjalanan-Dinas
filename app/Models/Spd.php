<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spd extends Model
{
    use HasFactory;

    protected $table = 'spd';

    // Allow mass assignment for flexibility as requested
    protected $guarded = [];

    // Enable standard timestamps for created_at and updated_at
    public $timestamps = true;

    public function pegawais()
    {
        return $this->belongsToMany(PegawaiBkdSpd::class, 'spd_pegawai', 'spd_id', 'pegawai_id')
            ->withPivot('peran');
    }

    public function penandatangan()
    {
        return $this->belongsTo(Penandatangan::class, 'penandatangan_id');
    }

    public function pptk()
    {
        return $this->belongsTo(Penandatangan::class, 'pptk_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
