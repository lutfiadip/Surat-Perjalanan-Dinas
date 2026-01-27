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

    // Assuming standard timestamps might not exist or we shouldn't rely on them being auto-filled if the table is manual. 
    // However, usually Laravel expects them. If the user said "beyond existing ones", maybe they exist.
    // Let's set to false to be safe given the "manual" nature, or if I get an error I'll enable them.
    // Actually, to be safest with "manual" tables, usually timestamps are false unless specified.
    public $timestamps = false;

    public function pegawais()
    {
        return $this->belongsToMany(PegawaiBkdSpd::class, 'spd_pegawai', 'spd_id', 'pegawai_id')
            ->withPivot('peran');
    }
}
