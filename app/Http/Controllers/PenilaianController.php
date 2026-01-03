<?php

namespace App\Http\Controllers;

use App\Models\Penilaian_kinerja;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Absensi;
use App\Models\Agenda;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PenilaianController extends Controller
{
    private $menu = 'penilaian_kinerja';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu = $this->menu;
        $datas = Penilaian_kinerja::with('user')->orderBy('bulan', 'desc')->get();
        return view('pages.admin.penilaian_kinerja.index', compact('datas', 'menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menu = $this->menu;
        $users = User::where('role', 'user')->get();
        return view('pages.admin.penilaian_kinerja.create', compact('users', 'menu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'bulan' => 'required|date_format:Y-m',
        ]);

        try {
            DB::beginTransaction();

            $user_id = $request->user_id;
            $bulan = $request->bulan;

            // Cek duplikasi penilaian
            $existing = Penilaian_kinerja::where('user_id', $user_id)
                ->where('bulan', $bulan)
                ->exists();

            if ($existing) {
                return redirect()->back()
                    ->with('error', 'Penilaian untuk bulan tersebut sudah ada.')
                    ->withInput();
            }

            // Hitung nilai KPI
            $kpiData = $this->hitungKPI($user_id, $bulan);

            // Simpan hasil perhitungan
            Penilaian_kinerja::create([
                'user_id' => $user_id,
                'bulan' => $bulan,
                'kehadiran_mengajar' => $kpiData['kehadiran_mengajar'],
                'ketepatan_waktu' => $kpiData['ketepatan_waktu'],
                'jam_mengajar' => $kpiData['jam_mengajar'],
                'pengisian_nilai' => $kpiData['pengisian_nilai'],
                'kehadiran_rapat' => $kpiData['kehadiran_rapat'],
                'skor_akhir' => $kpiData['skor_akhir'],
                'kategori' => $kpiData['kategori'],
                'detail' => json_encode($kpiData['detail']),
            ]);

            DB::commit();

            return redirect()->route('penilaian_kinerja.index')
                ->with('success', 'Penilaian kinerja berhasil dibuat.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Menghitung nilai KPI berdasarkan data yang tersedia
     */
    private function hitungKPI($user_id, $bulan)
    {
        $startDate = Carbon::parse($bulan)->startOfMonth();
        $endDate = Carbon::parse($bulan)->endOfMonth();

        // Target hari hadir per rancangan:
        // - Wali Kelas  -> hari kerja bulan tsb.
        // - Guru Mapel  -> jumlah hari terjadwal mengajar (distinct tanggal jadwal pada bulan tsb.)
        $targetHari = $this->getTargetHariHadir($user_id, $bulan);

        // 1) Kehadiran Mengajar (%)
        $jumlahHadir = $this->getJumlahHadirHari($user_id, $startDate, $endDate);
        $jumlahTidakHadir = $this->getJumlahTidakHadirHari($user_id, $startDate, $endDate);

        $totalHari = $jumlahHadir + $jumlahTidakHadir;

        $kehadiranMengajar = ($totalHari > 0)
            ? ($jumlahHadir / $totalHari) * 100
            : 0;

        // 2) Ketepatan Waktu (%)
        $tepatWaktuHari = $this->getJumlahTepatWaktuHari($user_id, $startDate, $endDate);
        $ketepatanWaktu = ($targetHari > 0) ? ($tepatWaktuHari / $targetHari) * 100 : 0;

        // 3) Jam Mengajar (%)
        $jamTerlaksana = $this->getJamTerlaksana($user_id, $startDate, $endDate);
        $jamMaksimal = $this->getJamMaksimal($user_id, $bulan); // jam terjadwal bulan tsb.
        $jamMengajar = ($jamMaksimal > 0) ? ($jamTerlaksana / $jamMaksimal) * 100 : 0;

        // 4) Pengisian Nilai (%)
        $pengisianNilai = $this->getPengisianNilai($user_id, $startDate, $endDate); // Ya=100, Tidak=0 (lihat catatan fungsi)

        // 5) Kehadiran Rapat (%)
        $jumlahRapat = $this->getJumlahRapat($startDate, $endDate);
        $hadirRapat = $this->getHadirRapat($user_id, $startDate, $endDate);
        $kehadiranRapat = ($jumlahRapat > 0) ? ($hadirRapat / $jumlahRapat) * 100 : 0;

        // Bobot indikator sesuai dokumen (25/20/20/20/15)
        $bobot = [
            'kehadiran' => 0.25,
            'ketepatan' => 0.20,
            'jam' => 0.20,
            'nilai' => 0.20,
            'rapat' => 0.15,
        ];

        $skorAkhir =
            ($kehadiranMengajar * $bobot['kehadiran']) +
            ($ketepatanWaktu * $bobot['ketepatan']) +
            ($jamMengajar * $bobot['jam']) +
            ($pengisianNilai * $bobot['nilai']) +
            ($kehadiranRapat * $bobot['rapat']);

        $kategori = $this->getKategori($skorAkhir);

        $detail = [
            'target_hari' => $targetHari,
            'jumlah_hadir' => $jumlahHadir,
            'tepat_waktu_hari' => $tepatWaktuHari,
            'jam_terlaksana' => $jamTerlaksana,
            'jam_maksimal' => $jamMaksimal,
            'jumlah_rapat' => $jumlahRapat,
            'hadir_rapat' => $hadirRapat,
            'bobot' => $bobot,
        ];

        return [
            'kehadiran_mengajar' => round($kehadiranMengajar, 2),
            'ketepatan_waktu' => round($ketepatanWaktu, 2),
            'jam_mengajar' => round($jamMengajar, 2),
            'pengisian_nilai' => round($pengisianNilai, 2),
            'kehadiran_rapat' => round($kehadiranRapat, 2),
            'skor_akhir' => round($skorAkhir, 2),
            'kategori' => $kategori,
            'detail' => $detail,
        ];
    }

    /**
     * Target hari hadir per bulan:
     * - Wali Kelas  -> jumlah hari kerja
     * - Guru Mapel  -> jumlah hari TERJADWAL mengajar (distinct tanggal jadwal pada bulan tsb)
     */
    // Target hari hadir per bulan
    private function getTargetHariHadir($user_id, $bulan): int
    {
        $start = Carbon::parse($bulan)->startOfMonth()->startOfDay();
        $end = Carbon::parse($bulan)->endOfMonth()->endOfDay();

        return DB::table('jadwals')
            ->where('user_id', $user_id)
            ->whereBetween('tanggal', [$start, $end])
            ->select(DB::raw('COUNT(DISTINCT DATE(tanggal)) as cnt'))
            ->value('cnt') ?? 0;
    }


    // Jumlah HARI hadir (distinct tanggal), hanya yang terlaksana
    private function getJumlahHadir($user_id, $startDate, $endDate)
    {
        return Jadwal::where('user_id', $user_id) // <-- hilangkan "operator:"
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->where('keterangan', 'ya')
            ->count();
    }
    private function getJumlahHadirHari($user_id, $startDate, $endDate): int
    {
        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();

        $cnt = DB::table('jadwals')
            ->where('user_id', $user_id)
            ->whereBetween('tanggal', [$start, $end])
            ->where(function ($q) {
                // normalize keterangan: ya / y / yes / '1'
                $q->whereRaw("LOWER(COALESCE(keterangan, '')) IN ('ya','y','yes')")
                    ->orWhere('keterangan', '1')
                    ->orWhere('keterangan', true);
            })


            ->select(DB::raw('COUNT(DISTINCT DATE(tanggal)) as cnt'))
            ->value('cnt');

        return (int) $cnt;
    }

    private function getJumlahTidakHadirHari($user_id, $startDate, $endDate): int
    {
        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();

        return DB::table('jadwals')
            ->where('user_id', $user_id)
            ->whereBetween('tanggal', [$start, $end])
            ->where(function ($q) {
                $q->whereRaw("LOWER(COALESCE(keterangan, '')) IN ('tidak','t','no','0')")
                    ->orWhere('keterangan', false);
            })
            ->select(DB::raw('COUNT(DISTINCT DATE(tanggal)) as cnt'))
            ->value('cnt') ?? 0;
    }
    // Jumlah HARI tepat waktu (fallback: sama dengan hadir jika kolom 'terlambat' tidak ada)
    private function getJumlahTepatWaktuHari($user_id, $startDate, $endDate): int
    {
        $start = Carbon::parse($startDate)->startOfDay();
        $end = Carbon::parse($endDate)->endOfDay();

        // Base query: terlaksana
        $q = DB::table('jadwals')
            ->where('user_id', $user_id)
            ->whereBetween('tanggal', [$start, $end])
            ->where(function ($q2) {
                $q2->whereRaw("LOWER(COALESCE(keterangan, '')) IN ('ya','y','yes')")
                    ->orWhere('keterangan', '1')
                    ->orWhere('keterangan', true);
            });

        if (Schema::hasColumn('jadwals', 'terlambat')) {
            $q->where(function ($q3) {
                $q3->where('terlambat', 0)
                    ->orWhereNull('terlambat');
            });
        }

        $cnt = $q->select(DB::raw('COUNT(DISTINCT DATE(tanggal)) as cnt'))->value('cnt');

        return (int) $cnt;
    }

    /** Jam terlaksana (jam_selesai - jam_mulai) hanya yang keterangan = 'ya'  */
    private function getJamTerlaksana($user_id, $startDate, $endDate): float
    {
        $totalJam = Jadwal::where('user_id', $user_id)
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->where('keterangan', 'ya')
            ->sum(DB::raw('TIME_TO_SEC(TIMEDIFF(jam_selesai, jam_mulai)) / 3600'));

        return round($totalJam, 2);
    }

    /**
     * Jam maksimal bulan ini = total jam TERJADWAL (bukan asumsi).
     * Fallback (jika belum ada jadwal sama sekali):
     *   - Wali kelas: JP/hari * hari kerja (1 JP = 40 menit)
     *   - Mapel: 2 JP/kelas * jumlah minggu efektif (≈ ceil(hariKerja/5))
     */
    private function getJamMaksimal($user_id, $bulan): float
    {
        $start = Carbon::parse($bulan)->startOfMonth();
        $end = Carbon::parse($bulan)->endOfMonth();

        // Hitung total jam yang dijadwalkan berdasarkan jadwal yang ada
        $jamTerjadwal = Jadwal::where('user_id', $user_id)
            ->whereBetween('tanggal', [$start, $end])
            ->sum(DB::raw('TIME_TO_SEC(TIMEDIFF(jam_selesai, jam_mulai)) / 3600'));

        if ($jamTerjadwal > 0) {
            return round($jamTerjadwal, 2);
        }

        // Fallback: Gunakan perhitungan berdasarkan dokumen
        $user = User::find($user_id);
        $hariKerja = $this->getHariKerja($bulan);

        // Konversi JP ke jam (1 JP = 40 menit = 0.67 jam)
        $jpToHour = 40 / 60; // 0.67 jam per JP

        if ($user && str_contains(strtolower($user->jabatan ?? ''), 'wali kelas')) {
            $jpPerHari = 0;
            $jab = strtolower($user->jabatan);

            if (str_contains($jab, 'kelas 1') || str_contains($jab, 'kelas 2')) {
                $jpPerHari = 4;
            } elseif (str_contains($jab, 'kelas 3')) {
                $jpPerHari = 5;
            } else { // kelas 4/5/6
                $jpPerHari = 6;
            }
            return round($jpPerHari * $jpToHour * $hariKerja, 2);
        }

        // Untuk guru mapel, gunakan perhitungan berdasarkan contoh dokumen
        // Contoh: PJOK (1-3) memiliki 24 jam maksimal di bulan April
        $mingguEfektif = ceil($hariKerja / 7);

        // Default: 2 JP per pertemuan (sesuai contoh dokumen)
        $jpPerPertemuan = 2;
        $pertemuanPerMinggu = 1; // Default 1 pertemuan per minggu

        return round($jpPerPertemuan * $pertemuanPerMinggu * $mingguEfektif * $jpToHour, 2);
    }

    private function getHariKerja($bulan): int
    {
        $d = Carbon::parse($bulan)->startOfMonth();
        $end = Carbon::parse($bulan)->endOfMonth();
        $hari = 0;
        while ($d->lte($end)) {
            if (!$d->isWeekend())
                $hari++;
            $d->addDay();
        }
        return $hari;
    }

    /**
     * Pengisian Nilai:
     * - Jika Anda menyimpan flag bulanan (Ya/Tidak), ambil dari sana.
     * - Jika belum ada data, default 100 (sesuai tabel contoh pada dokumen). 
     */
    private function getPengisianNilai($user_id, $startDate, $endDate): float
    {
        // TODO: ganti dengan sumber data yang benar jika sudah ada (mis. kolom/relasi nilai).
        return 100.0;
    }

    /** Rapat: jumlah agenda bulan tsb. dan hadir=‘hadir’ */
    private function getJumlahRapat($startDate, $endDate): int
    {
        return Agenda::whereBetween('tgl_kegiatan', [$startDate, $endDate])->count();
    }

    private function getHadirRapat($user_id, $startDate, $endDate): int
    {
        return Absensi::where('user_id', $user_id)
            ->whereHas('agenda', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('tgl_kegiatan', [$startDate, $endDate]);
            })
            ->where('status', 'hadir')
            ->count();
    }

    /** Kategori sesuai dokumen: A≥90, B 80–89, C 70–79, D<70 */
    private function getKategori($skor): string
    {
        if ($skor >= 90)
            return 'Sangat Baik';
        if ($skor >= 80)
            return 'Baik';
        if ($skor >= 70)
            return 'Cukup';
        return 'Kurang';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $menu = $this->menu;
        $penilaian = Penilaian_kinerja::findOrFail($id);
        $users = User::where('role', 'user')->get();
        return view('pages.admin.penilaian_kinerja.edit', compact('penilaian', 'users', 'menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:penilaian_kinerjas,id',
            'kehadiran_mengajar' => 'required|numeric|between:0,100',
            'ketepatan_waktu' => 'required|numeric|between:0,100',
            'jam_mengajar' => 'required|numeric|between:0,100',
            'pengisian_nilai' => 'required|numeric|between:0,100',
            'kehadiran_rapat' => 'required|numeric|between:0,100',
        ]);

        try {
            $penilaian = Penilaian_kinerja::findOrFail($request->id);

            // Hitung ulang skor akhir
            $bobot = [
                'kehadiran' => 0.25,
                'ketepatan' => 0.20,
                'jam' => 0.20,
                'nilai' => 0.20,
                'rapat' => 0.15
            ];

            $skorAkhir =
                ($request->kehadiran_mengajar * $bobot['kehadiran']) +
                ($request->ketepatan_waktu * $bobot['ketepatan']) +
                ($request->jam_mengajar * $bobot['jam']) +
                ($request->pengisian_nilai * $bobot['nilai']) +
                ($request->kehadiran_rapat * $bobot['rapat']);

            $kategori = $this->getKategori($skorAkhir);

            $penilaian->update([
                'kehadiran_mengajar' => $request->kehadiran_mengajar,
                'ketepatan_waktu' => $request->ketepatan_waktu,
                'jam_mengajar' => $request->jam_mengajar,
                'pengisian_nilai' => $request->pengisian_nilai,
                'kehadiran_rapat' => $request->kehadiran_rapat,
                'skor_akhir' => round($skorAkhir, 2),
                'kategori' => $kategori,
            ]);

            return redirect()->route('penilaian_kinerja.index')
                ->with('success', 'Penilaian kinerja berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $penilaian = Penilaian_kinerja::findOrFail($id);
            $penilaian->delete();

            return redirect()->route('penilaian_kinerja.index')
                ->with('success', 'Penilaian kinerja berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}