<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'laporan_id',
        'teknisi_id',
        'supervisor_id',
        'catatan_penugasan',
        'status', // ditugaskan | dikerjakan | selesai
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function hasilPerbaikan()
    {
        return $this->hasOne(HasilPerbaikan::class);
    }
}
