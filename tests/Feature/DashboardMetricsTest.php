<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardMetricsTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_and_admin_dashboard_share_database_loan_activity(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $borrower = User::factory()->create(['role' => 'siswa']);
        $barang = Barang::create([
            'kode_barang' => 'METRIC-001',
            'nama_barang' => 'Laptop',
            'stok_total' => 5,
            'stok_tersedia' => 4,
            'kondisi' => 'baik',
            'status_barang' => 'tersedia',
        ]);
        Barang::create([
            'kode_barang' => 'METRIC-002',
            'nama_barang' => 'Kamera rusak',
            'stok_total' => 1,
            'stok_tersedia' => 0,
            'kondisi' => 'rusak_berat',
            'status_barang' => 'perbaikan',
        ]);

        Peminjaman::create([
            'barang_id' => $barang->id,
            'user_id' => $borrower->id,
            'nama_peminjam' => $borrower->name,
            'jumlah' => 1,
            'tanggal_pinjam' => today(),
            'tanggal_kembali_rencana' => today()->addDays(2),
            'status' => 'pending',
        ]);

        Peminjaman::create([
            'barang_id' => $barang->id,
            'user_id' => $borrower->id,
            'nama_peminjam' => $borrower->name,
            'jumlah' => 1,
            'tanggal_pinjam' => today()->subDays(3),
            'tanggal_kembali_rencana' => today()->subDay(),
            'status' => 'dipinjam',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertViewHas('barangTersedia', 4)
            ->assertViewHas('weeklyTotal', 2)
            ->assertViewHas('weeklyLoans', fn (array $loans): bool => count($loans) === 7 && array_sum($loans) === 2)
            ->assertSee('Tidak tersedia');

        $this->actingAs($admin)
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Data Barang')
            ->assertSee('Data Master')
            ->assertSee('Kategori')
            ->assertSee('Lokasi barang')
            ->assertSee('Laporan')
            ->assertViewHas('todayLoans', 1)
            ->assertViewHas('terlambat', 1)
            ->assertViewHas('weeklyTotal', 2)
            ->assertViewHas('weeklyLoans', fn (array $loans): bool => count($loans) === 7 && array_sum($loans) === 2);

        $this->actingAs($borrower)
            ->get('/dashboard')
            ->assertSee('Dashboard')
            ->assertSee('Katalog')
            ->assertSee('Peminjaman')
            ->assertSee('Notifikasi')
            ->assertSee(route('profile.edit'), false)
            ->assertDontSee('Data Master')
            ->assertDontSee('Laporan');
    }
}
