<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Alur status laporan sesuai mockup:
    // baru -> divalidasi -> ditugaskan -> dikerjakan -> menunggu_validasi_akhir -> selesai
    // baru -> ditolak (apabila Supervisor menolak saat validasi awal)
    const STATUS_BARU = 'baru';
    const STATUS_DIVALIDASI = 'divalidasi';
    const STATUS_DITUGASKAN = 'ditugaskan';
    const STATUS_DIKERJAKAN = 'dikerjakan';
    const STATUS_MENUNGGU_VALIDASI_AKHIR = 'menunggu_validasi_akhir';
    const STATUS_SELESAI = 'selesai';
    const STATUS_DITOLAK = 'ditolak';

    protected $fillable = [
        'kode',
        'operator_id',
        'mesin',
        'lokasi',
        'kategori',        // mekanik | elektrik | instrumentasi
        'kondisi',
        'tingkat',         // ringan | sedang | berat
        'deskripsi',
        'foto',
        'status',
        'catatan_supervisor',
        'catatan_penolakan',
    ];

    public static function labelStatus(string $status): string
    {
        return match ($status) {
            self::STATUS_BARU => 'Menunggu Validasi',
            self::STATUS_DIVALIDASI => 'Tervalidasi',
            self::STATUS_DITUGASKAN => 'Ditugaskan',
            self::STATUS_DIKERJAKAN => 'Sedang Ditangani',
            self::STATUS_MENUNGGU_VALIDASI_AKHIR => 'Menunggu Validasi Akhir',
            self::STATUS_SELESAI => 'Selesai',
            self::STATUS_DITOLAK => 'Ditolak',
            default => ucfirst($status),
        };
    }

    public function operator()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function penugasan()
    {
        return $this->hasOne(Penugasan::class);
    }
}
