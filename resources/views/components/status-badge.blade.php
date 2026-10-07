@props(['status'])

@php
    $statusKey = $status === 'dikembalikan' ? 'selesai' : $status;
    $statusLabels = [
        'pending' => 'Menunggu',
        'disetujui' => 'Disetujui',
        'ditolak' => 'Ditolak',
        'dipinjam' => 'Dipinjam',
        'terlambat' => 'Terlambat',
        'selesai' => 'Selesai',
    ];
    $statusClass = array_key_exists($statusKey, $statusLabels) ? $statusKey : 'unknown';
    $statusLabel = $statusLabels[$statusKey] ?? 'Status tidak dikenal';
@endphp

<span {{ $attributes->class(['system-status', 'system-status--' . $statusClass]) }}>{{ $statusLabel }}</span>
