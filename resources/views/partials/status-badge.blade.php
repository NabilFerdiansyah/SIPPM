@php
$map = [
  'baru' => 'b-amber',
  'divalidasi' => 'b-blue',
  'ditugaskan' => 'b-blue',
  'dikerjakan' => 'b-blue',
  'menunggu_validasi_akhir' => 'b-amber',
  'selesai' => 'b-green',
  'ditolak' => 'b-red',
];
$class = $map[$status] ?? 'b-gray';
$labels = [
  'baru' => 'Menunggu Validasi',
  'divalidasi' => 'Tervalidasi',
  'ditugaskan' => 'Ditugaskan',
  'dikerjakan' => 'Sedang Ditangani',
  'menunggu_validasi_akhir' => 'Menunggu Validasi Akhir',
  'selesai' => 'Selesai',
  'ditolak' => 'Ditolak',
];
@endphp
<span class="badge {{ $class }}">{{ $labels[$status] ?? ucfirst($status) }}</span>
