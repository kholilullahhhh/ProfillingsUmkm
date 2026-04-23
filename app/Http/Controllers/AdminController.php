<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Umkm;
use App\Models\Pembinaan;
use App\Models\Produk;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameters
        $selectedMonth = $request->month ?? date('n');
        $selectedYear = $request->year ?? date('Y');

        // ========== DATA UMKM ==========
        $totalUMKM = Umkm::count();
        $totalProduk = Produk::count();

        // UMKM berdasarkan skala usaha
        $umkmByScale = [
            'mikro' => Umkm::where('skala_usaha', 'mikro')->count(),
            'kecil' => Umkm::where('skala_usaha', 'kecil')->count(),
            'menengah' => Umkm::where('skala_usaha', 'menengah')->count(),
        ];

        // UMKM berdasarkan status binaan
        $umkmBinaan = Umkm::where('status_binaan', true)->count();
        $umkmNonBinaan = Umkm::where('status_binaan', false)->count();

        // UMKM berdasarkan jenis usaha
        $umkmByJenisUsaha = Umkm::selectRaw('jenis_usaha_id, count(*) as total')
            ->with('jenisUsaha')
            ->groupBy('jenis_usaha_id')
            ->get()
            ->mapWithKeys(function ($item) {
                $jenisUsahaName = $item->jenisUsaha ? $item->jenisUsaha->nama : 'Tidak Terdefinisi';
                return [$jenisUsahaName => $item->total];
            })
            ->toArray();

        // ========== DATA PEMBINAAN UMKM ==========
        $totalPembinaan = Pembinaan::count();

        // Pembinaan per bulan (untuk chart)
        $startDate = Carbon::create($selectedYear, $selectedMonth, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        $daysInMonth = $startDate->daysInMonth;
        $dateLabels = [];
        $monthlyPembinaan = array_fill(0, $daysInMonth, 0);

        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dateLabels[] = $i;
        }

        // Get pembinaan data for the month
        $dailyPembinaan = Pembinaan::whereBetween('tanggal', [$startDate, $endDate])
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->tanggal)->format('j');
            });

        foreach ($dailyPembinaan as $day => $pembinaans) {
            $dayIndex = (int) $day - 1;
            $monthlyPembinaan[$dayIndex] = count($pembinaans);
        }

        // Data perkembangan pembinaan (6 bulan terakhir)
        $last6Months = [];
        $monthlyPembinaanTrend = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthName = $month->format('M Y');
            $last6Months[] = $monthName;

            $count = Pembinaan::whereYear('tanggal', $month->year)
                ->whereMonth('tanggal', $month->month)
                ->count();
            $monthlyPembinaanTrend[] = $count;
        }

        // Statistik pembinaan berdasarkan UMKM
        $pembinaanStats = [
            'total_sessions' => $totalPembinaan,
            'avg_per_umkm' => $totalUMKM > 0 ? round($totalPembinaan / $totalUMKM, 2) : 0,
            'months_with_data' => Pembinaan::selectRaw('YEAR(tanggal) as year, MONTH(tanggal) as month')
                ->distinct()
                ->count()
        ];

        // UMKM dengan pembinaan terbanyak
        $topUMKMByPembinaan = Umkm::withCount('pembinaan')
            ->orderBy('pembinaan_count', 'desc')
            ->take(5)
            ->get();

        // Recent pembinaan data
        $recentPembinaan = Pembinaan::with('umkm')
            ->latest()
            ->take(5)
            ->get();

        // Recent UMKM yang terdaftar
        $recentUMKM = Umkm::with('jenisUsaha')
            ->latest()
            ->take(5)
            ->get();

        // Produk terbaru
        $recentProduk = Produk::with('umkm')
            ->latest()
            ->take(5)
            ->get();

        // Omzet UMKM (Rata-rata dan total)
        $totalOmzet = Umkm::sum('omset_per_tahun');
        $averageOmzet = $totalUMKM > 0 ? $totalOmzet / $totalUMKM : 0;

        // Omzet berdasarkan skala usaha
        $omzetByScale = [
            'mikro' => Umkm::where('skala_usaha', 'mikro')->sum('omset_per_tahun'),
            'kecil' => Umkm::where('skala_usaha', 'kecil')->sum('omset_per_tahun'),
            'menengah' => Umkm::where('skala_usaha', 'menengah')->sum('omset_per_tahun'),
        ];

        // Distribusi tahun berdiri UMKM
        $tahunBerdiriDistribution = Umkm::selectRaw('tahun_berdiri, count(*) as total')
            ->whereNotNull('tahun_berdiri')
            ->groupBy('tahun_berdiri')
            ->orderBy('tahun_berdiri', 'desc')
            ->take(10)
            ->get()
            ->pluck('total', 'tahun_berdiri')
            ->toArray();

        return view('pages.admin.dashboard.index', [
            'menu' => 'dashboard',

            // Data UMKM
            'totalUMKM' => $totalUMKM,
            'totalProduk' => $totalProduk,
            'umkmByScale' => $umkmByScale,
            'umkmBinaan' => $umkmBinaan,
            'umkmNonBinaan' => $umkmNonBinaan,
            'umkmByJenisUsaha' => $umkmByJenisUsaha,

            // Data Pembinaan
            'totalPembinaan' => $totalPembinaan,
            'pembinaanStats' => $pembinaanStats,
            'monthlyPembinaan' => $monthlyPembinaan,
            'dateLabels' => $dateLabels,
            'monthlyPembinaanTrend' => $monthlyPembinaanTrend,
            'last6Months' => $last6Months,

            // Data Omzet
            'totalOmzet' => $totalOmzet,
            'averageOmzet' => $averageOmzet,
            'omzetByScale' => $omzetByScale,

            // Data lainnya
            'tahunBerdiriDistribution' => $tahunBerdiriDistribution,

            // Recent data
            'recentPembinaan' => $recentPembinaan,
            'recentUMKM' => $recentUMKM,
            'recentProduk' => $recentProduk,
            'topUMKMByPembinaan' => $topUMKMByPembinaan,

            // Filter data
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear
        ]);
    }
}