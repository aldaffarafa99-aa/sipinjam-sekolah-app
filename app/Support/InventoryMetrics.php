<?php

namespace App\Support;

use App\Models\Peminjaman;

class InventoryMetrics
{
    public function weeklyLoanActivity(): array
    {
        $today = today();
        $start = $today->copy()->subDays(6);
        $countsByDate = Peminjaman::query()
            ->selectRaw('DATE(tanggal_pinjam) as tanggal, COUNT(*) as jumlah')
            ->whereDate('tanggal_pinjam', '>=', $start->toDateString())
            ->whereDate('tanggal_pinjam', '<=', $today->toDateString())
            ->groupByRaw('DATE(tanggal_pinjam)')
            ->pluck('jumlah', 'tanggal');
        $labels = [];
        $counts = [];

        for ($daysAgo = 6; $daysAgo >= 0; $daysAgo--) {
            $date = $today->copy()->subDays($daysAgo);
            $labels[] = $date->locale('id')->translatedFormat('D');
            $counts[] = (int) ($countsByDate[$date->toDateString()] ?? 0);
        }

        return [
            'weeklyLabels' => $labels,
            'weeklyLoans' => $counts,
            'weeklyTotal' => array_sum($counts),
        ];
    }
}
