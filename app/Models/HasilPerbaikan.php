<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPerbaikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penugasan_id',
        'tindakan_perbaikan',
        'komponen_diganti',
        'waktu_mulai',
        'waktu_selesai',
        'catatan_teknisi',
        'foto_hasil',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function penugasan()
    {
        return $this->belongsTo(Penugasan::class);
    }
}
