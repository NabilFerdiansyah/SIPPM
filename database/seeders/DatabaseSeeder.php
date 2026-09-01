<?php

namespace Database\Seeders;

use App\Models\HasilPerbaikan;
use App\Models\Laporan;
use App\Models\Penugasan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==== Akun demo (sesuai mockup) ====
        $operator = User::create([
            'name' => 'Andi Wijaya',
            'username' => 'andi.operator',
            'password' => Hash::make('password'),
            'role' => 'operator',
            'jabatan' => 'Gilingan',
            'no_hp' => '081234560001',
            'status' => 'aktif',
        ]);

        $supervisor = User::create([
            'name' => 'Sri Handayani',
            'username' => 'sri.supervisor',
            'password' => Hash::make('password'),
            'role' => 'supervisor',
            'jabatan' => 'Produksi',
            'no_hp' => '081234560002',
            'status' => 'aktif',
        ]);

        $teknisi = User::create([
            'name' => 'Budi Santoso',
            'username' => 'budi.teknisi',
            'password' => Hash::make('password'),
            'role' => 'teknisi',
            'jabatan' => 'Maintenance',
            'no_hp' => '081234560003',
            'status' => 'aktif',
        ]);

        $teknisi2 = User::create([
            'name' => 'Rudi Hartono',
            'username' => 'rudi.teknisi',
            'password' => Hash::make('password'),
            'role' => 'teknisi',
            'jabatan' => 'Maintenance',
            'no_hp' => '081234560004',
            'status' => 'aktif',
        ]);

        // ==== Contoh data laporan pada berbagai tahap alur ====
        $l1 = Laporan::create([
            'kode' => 'LAP-'.date('Ymd').'-001',
            'operator_id' => $operator->id,
            'mesin' => 'Gilingan I',
            'lokasi' => 'Stasiun Gilingan',
            'kategori' => 'mekanik',
            'kondisi' => 'Bearing rusak/aus',
            'tingkat' => 'berat',
            'deskripsi' => 'Terdengar suara kasar dari bearing utama gilingan I disertai getaran berlebih.',
            'status' => Laporan::STATUS_BARU,
        ]);

        $l2 = Laporan::create([
            'kode' => 'LAP-'.date('Ymd').'-002',
            'operator_id' => $operator->id,
            'mesin' => 'Motor Konveyor 3',
            'lokasi' => 'Stasiun Boiler',
            'kategori' => 'elektrik',
            'kondisi' => 'Motor overheat',
            'tingkat' => 'sedang',
            'deskripsi' => 'Motor konveyor 3 panas berlebih setelah beroperasi 2 jam.',
            'status' => Laporan::STATUS_DITUGASKAN,
        ]);
        $p2 = Penugasan::create([
            'laporan_id' => $l2->id,
            'teknisi_id' => $teknisi->id,
            'supervisor_id' => $supervisor->id,
            'catatan_penugasan' => 'Segera cek kondisi kumparan motor dan sistem pendingin.',
            'status' => 'ditugaskan',
        ]);

        $l3 = Laporan::create([
            'kode' => 'LAP-'.date('Ymd').'-003',
            'operator_id' => $operator->id,
            'mesin' => 'Sensor Tekanan Boiler',
            'lokasi' => 'Stasiun Boiler',
            'kategori' => 'instrumentasi',
            'kondisi' => 'Sensor tekanan rusak',
            'tingkat' => 'sedang',
            'deskripsi' => 'Pembacaan tekanan pada panel tidak sesuai kondisi aktual.',
            'status' => Laporan::STATUS_MENUNGGU_VALIDASI_AKHIR,
        ]);
        $p3 = Penugasan::create([
            'laporan_id' => $l3->id,
            'teknisi_id' => $teknisi->id,
            'supervisor_id' => $supervisor->id,
            'catatan_penugasan' => 'Kalibrasi ulang sensor tekanan.',
            'status' => 'selesai',
        ]);
        HasilPerbaikan::create([
            'penugasan_id' => $p3->id,
            'tindakan_perbaikan' => 'Sensor tekanan dikalibrasi ulang dan kabel sinyal diperbaiki.',
            'komponen_diganti' => 'Tidak ada penggantian komponen',
            'waktu_mulai' => now()->subHours(3),
            'waktu_selesai' => now()->subHour(),
            'catatan_teknisi' => 'Pembacaan sudah normal kembali sesuai standar.',
        ]);

        $l4 = Laporan::create([
            'kode' => 'LAP-'.date('Ymd', strtotime('-3 day')).'-004',
            'operator_id' => $operator->id,
            'mesin' => 'Gearbox Gilingan II',
            'lokasi' => 'Stasiun Gilingan',
            'kategori' => 'mekanik',
            'kondisi' => 'Gearbox bermasalah',
            'tingkat' => 'berat',
            'deskripsi' => 'Gearbox gilingan II macet dan mengeluarkan bau terbakar.',
            'status' => Laporan::STATUS_SELESAI,
        ]);
        $p4 = Penugasan::create([
            'laporan_id' => $l4->id,
            'teknisi_id' => $teknisi2->id,
            'supervisor_id' => $supervisor->id,
            'catatan_penugasan' => 'Periksa oli gearbox dan sistem pendingin.',
            'status' => 'selesai',
        ]);
        HasilPerbaikan::create([
            'penugasan_id' => $p4->id,
            'tindakan_perbaikan' => 'Oli gearbox diganti dan gear yang aus diganti baru.',
            'komponen_diganti' => 'Gear set, oli gearbox',
            'waktu_mulai' => now()->subDays(3)->subHours(2),
            'waktu_selesai' => now()->subDays(3),
            'catatan_teknisi' => 'Gearbox sudah beroperasi normal, disarankan pengecekan rutin tiap bulan.',
        ]);

        $l5 = Laporan::create([
            'kode' => 'LAP-'.date('Ymd', strtotime('-1 day')).'-005',
            'operator_id' => $operator->id,
            'mesin' => 'Panel Listrik Utama',
            'lokasi' => 'Ruang Panel',
            'kategori' => 'elektrik',
            'kondisi' => 'MCB/MCCB trip',
            'tingkat' => 'ringan',
            'deskripsi' => 'MCB sering trip tanpa sebab yang jelas.',
            'status' => Laporan::STATUS_DITOLAK,
            'catatan_penolakan' => 'Data kurang lengkap, mohon lampirkan foto kondisi panel.',
        ]);
    }
}
