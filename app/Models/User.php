<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',        // operator | supervisor | teknisi
        'jabatan',     // contoh: Gilingan, Produksi, Maintenance
        'no_hp',
        'status',      // aktif | nonaktif
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function initials(): string
    {
        $words = preg_split('/\s+/', trim($this->name));
        $initials = '';
        foreach (array_slice($words, 0, 2) as $w) {
            $initials .= mb_strtoupper(mb_substr($w, 0, 1));
        }
        return $initials ?: 'U';
    }

    public function laporanDibuat()
    {
        return $this->hasMany(Laporan::class, 'operator_id');
    }

    public function penugasanSayaSebagaiTeknisi()
    {
        return $this->hasMany(Penugasan::class, 'teknisi_id');
    }
}
