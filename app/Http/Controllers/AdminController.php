<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Agenda;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */


public function index(Request $request)
    {
        // Get filter parameters
        $selectedMonth = $request->month ?? date('n');
        $selectedYear = $request->year ?? date('Y');
        
        // Get date range for the selected month
        $startDate = Carbon::create($selectedYear, $selectedMonth, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();
        
        // Get days in month for chart labels
        $daysInMonth = $startDate->daysInMonth;
        $dateLabels = [];
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $dateLabels[] = $i;
        }
        
        // Initialize arrays for daily attendance data
        $monthlyHadir = array_fill(0, $daysInMonth, 0);
        $monthlyTidakHadir = array_fill(0, $daysInMonth, 0);
        $monthlyIzin = array_fill(0, $daysInMonth, 0);
        
        // Get attendance data for the month
        $dailyAttendances = Absensi::with('agenda')
            ->whereHas('agenda', function($query) use ($startDate, $endDate) {
                $query->whereBetween('tgl_kegiatan', [$startDate, $endDate]);
            })
            ->get()
            ->groupBy(function($item) {
                return Carbon::parse($item->agenda->tgl_kegiatan)->format('j'); // Day of month without leading zeros
            });
        
        // Populate the daily attendance data
        foreach ($dailyAttendances as $day => $attendances) {
            $dayIndex = (int)$day - 1; // Convert to 0-based index
            
            foreach ($attendances as $attendance) {
                switch ($attendance->status) {
                    case 'hadir':
                        $monthlyHadir[$dayIndex]++;
                        break;
                    case 'tidak_hadir':
                        $monthlyTidakHadir[$dayIndex]++;
                        break;
                    case 'izin':
                        $monthlyIzin[$dayIndex]++;
                        break;
                }
            }
        }
        
        // Get attendance statistics
        $totalAttendances = Absensi::count();
        $hadirCount = Absensi::where('status', 'hadir')->count();
        $tidakHadirCount = Absensi::where('status', 'tidak hadir')->count();
        $izinCount = Absensi::where('status', 'izin')->count();
        
        // Calculate percentages
        $hadirPercentage = $totalAttendances > 0 ? round(($hadirCount / $totalAttendances) * 100) : 0;
        $tidakHadirPercentage = $totalAttendances > 0 ? round(($tidakHadirCount / $totalAttendances) * 100) : 0;
        $izinPercentage = $totalAttendances > 0 ? round(($izinCount / $totalAttendances) * 100) : 0;
        
        // Get recent data
        $recentAttendances = Absensi::with(['user', 'agenda'])
            ->latest()
            ->take(5)
            ->get();
            
        $upcomingAgendas = Agenda::where('tgl_kegiatan', '>=', now())
            ->orderBy('tgl_kegiatan')
            ->take(5)
            ->get();

        return view('pages.admin.dashboard.index', [
            'menu' => 'dashboard',
            'totalAgendas' => Agenda::count(),
            'hadirCount' => $hadirCount,
            'tidakHadirCount' => $tidakHadirCount,
            'izinCount' => $izinCount,
            'hadirPercentage' => $hadirPercentage,
            'tidakHadirPercentage' => $tidakHadirPercentage,
            'izinPercentage' => $izinPercentage,
            'monthlyHadir' => $monthlyHadir,
            'monthlyTidakHadir' => $monthlyTidakHadir,
            'monthlyIzin' => $monthlyIzin,
            'dateLabels' => $dateLabels,
            'recentAttendances' => $recentAttendances,
            'upcomingAgendas' => $upcomingAgendas,
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear
        ]);
    }




    private function getPaymentPercentage($status)
    {
        $total = Payment::count();
        if ($total == 0)
            return 0;

        return round((Payment::where('status', $status)->count() / $total) * 100, 2);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function profile($id)
    {
        $data = Admin::find($id);
        return view('pages.admin.profile.index', ['menu' => 'profile', 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function profile_update(Request $request)
    {
        $r = $request->all();
        // $update_nik = Pegawai::where('nama_lengkap', $r['name'])->first();
        // $update->nik();


        // dd( $r['id']);
        $admin = Admin::find($r['id']);
        $user = User::find($r['id']);
        if ($r['password'] != null) {
            $r['password'] = bcrypt($r['password']);
            // dump('ubah password');
        } else {
            unset($r['password']);
        }
        // dd(true);

        $admin->update($r);
        $user->update($r);

        return redirect()->route('dashboard')->with('message', 'update profile');
    }

}
