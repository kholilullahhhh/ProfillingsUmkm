<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AbsenController;
use App\Http\Controllers\User\JadwalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//  User
Route::group(
    ['prefix' => '', 'namespace' => 'App\Http\Controllers\User'],
    function () {
        Route::redirect('/', '/');
        // Dashboard
    
        //         Route::get(
        //             '/',
        //             function () {
        //                 return view('pages.landing.index');
        //             }
        //         )->name('user.index');
    
        // Route::get(
        //     '/',
        //     function () {
        //         return view('pages.landing.index');
        //     }
        // )->name('user.index');
    
        Route::get('/', 'UserController@index')->name('user.index');
        Route::get('/kontak', 'UserController@kontak')->name('user.kontak');
        Route::get('/eksternal', 'UserController@guru')->name('user.guru');

        Route::get('/detail/{jenis}/{id}', 'UserController@detail')->name('user.detail.post');


        Route::get('/pegawai', 'UserController@pegawai')->name('user.pegawai');
        Route::get('/pegawai/form', 'UserController@form_pegawai')->name('user.form_pegawai');
        Route::post('/pegawai/daftar', 'UserController@daftar_pegawai')->name('user.daftar_pegawai');
        Route::get('/pegawai/all', 'UserController@getPenugasanAll')->name('user.pegawai.all');
        Route::get('/pegawai/detail', 'UserController@getPenugasanDetail')->name('user.pegawai.detail');
        Route::get('/pegawai/detailLoka', 'UserController@getPenugasanDetailLoka')->name('user.pegawai.detail.loka');
        Route::get('/pegawai/detailEksternal', 'UserController@getPenugasanDetailEksternal')->name('user.pegawai.detail.eksternal');

        Route::get('/statistik', 'UserController@statistik')->name('user.statistik');
        Route::get('/api/statistics/month/{month}', 'UserController@getMonthStatistics')->name('user.statistik.month');
        Route::get('/api/statistics/activities/{month}', 'UserController@getActivitiesByMonth')->name('user.statistik.month');
        Route::get('/api/statistics/activity/{activityId}/{participantType}', 'UserController@getActivityStatistics')->name('user.statistik.activity');

        Route::get('/eksternal', 'UserController@guru')->name('user.guru');
        Route::get('/eksternal/form/{jenis}', 'UserController@form_guru')->name('user.form_guru');
        Route::post('/eksternal/daftar', 'UserController@daftar_guru')->name('user.daftar_guru');

        Route::get('/kegiatan', 'KegiatanController@index')->name('user.kegiatan');
        Route::get('/kegiatan/cari', 'KegiatanController@cari')->name('user.cari');

        Route::get('/kegiatan/registrasi', 'KegiatanController@regist')->name('user.kegiatan_regist');
        Route::post('/kegiatan/store', 'KegiatanController@store')->name('user.kegiatan_store');

        // response json
        Route::get('/kegiatan/getStatus', 'KegiatanController@getStatus')->name('user.kegiatan.getStatus');
        Route::get('/kegiatan/cariPeserta', 'KegiatanController@cariPeserta')->name('user.kegiatan.cariPeserta');
        Route::get('/kegiatan/peserta', 'KegiatanController@getPesertaByKegiatan')->name('user.kegiatan.peserta');
        Route::get('/peserta/detail', 'KegiatanController@getPesertaDetail')->name('user.peserta.detail');

        // trace pesrta dari kegiatan sebelum nya
        Route::get('/peserta/cekData', 'KegiatanController@cekDataPeserta')->name('user.peserta.cekData');

        Route::get('/print/absensi-peserta', 'KegiatanController@printAbsensiPeserta')->name('print.absensi.peserta');
        Route::get('/print/registrasi-peserta', 'KegiatanController@fprintRegistrasiPeserta')->name('print.registrasi.peserta');
        Route::get('/print/absensi-panitia', 'KegiatanController@printAbsensiPanitia')->name('print.absensi.panitia');
        Route::get('/print/absensi-narasumber', 'KegiatanController@printAbsensiNarasumber')->name('print.absensi.narasumber');

        Route::get('/print/absensi-tp', 'KegiatanController@printAbsensiTp')->name('print.absensi.tp');
        Route::get('/print/absensi-tkp', 'KegiatanController@printAbsensiTkp')->name('print.absensi.tkp');
        Route::get('/print/absensi-stk', 'KegiatanController@printAbsensiStk')->name('print.absensi.stk');
        Route::get('/print/absensi-pgw', 'KegiatanController@printAbsensiPgw')->name('print.absensi.pgw');
    }
);

// Route::get('/', function () {
//     return view('welcome');
// });

//User
// Route::group(
//     ['prefix' => '', 'namespace' => 'App\Http\Controllers\Siswa', 'middleware' => 'ValidasiUser'],
//     function () {
//         Route::redirect('/', 'dahboard/');
//         // Dashboard
//         Route::prefix('dashboard')->group(function () {


//         });
//     }
// );
// User routes



// Admin
Route::group(
    ['prefix' => '', 'namespace' => 'App\Http\Controllers', 'middleware' => 'ValidasiUser'],
    function () {
        Route::redirect('/admin', 'dashboard/');
        // Dashboard
        Route::prefix('dashboard')->group(function () {

            // Root
            Route::get('/', 'AdminController@index')->name('dashboard');
            Route::get('/jadwalKegiatan', 'AdminController@jadwal')->name('dashboard.jadwal');
            Route::get('/jadwalKegiatan/{nik}', 'AdminController@getJadwalByPegawai')->name('dashboard.jadwal.getByPegawai');

            Route::get('/getByKegiatan', 'AdminController@getByKegiatan')->name('dashboard.jadwal.getByKegiatan')->withoutMiddleware(['ValidasiUser']);
            Route::get('/getByKegiatanUser', 'AdminController@getByKegiatanUser')->name('dashboard.jadwal.getByKegiatanUser')->withoutMiddleware(['ValidasiUser']);

            // Profile User yang Login
            Route::get('/profile/{id}', 'AdminController@profile')->name('profile.index');
            Route::put('/profile/update', 'AdminController@profile_update')->name('profile.update');

            Route::get('/fetch-sekolah', ['GuruController@index', 'fetchSekolah'])->name('fetchSekolah');


            // Pegawai
            Route::prefix('pegawai')->group(function () {
                Route::get('/', 'PegawaiController@index')->name('pegawai.index');
                Route::get('/create', 'PegawaiController@create')->name('pegawai.create');
                Route::post('/store', 'PegawaiController@store')->name('pegawai.store');
                Route::get('/edit/{id}', 'PegawaiController@edit')->name('pegawai.edit');
                Route::put('/update', 'PegawaiController@update')->name('pegawai.update');
                // Route::post('/hapus/{id}', 'PegawaiController@destroy')->name('pegawai.hapus');
                Route::delete('/hapus/{id}', 'PegawaiController@destroy')->name('pegawai.hapus');
            });

            // Indikator
            Route::prefix('indikator')->group(function () {
                Route::get('/', 'IndicatorsController@index')->name('indikator.index');
                Route::get('/create', 'IndicatorsController@create')->name('indikator.create');
                Route::post('/store', 'IndicatorsController@store')->name('indikator.store');
                Route::get('/edit/{id}', 'IndicatorsController@edit')->name('indikator.edit');
                Route::put('/update', 'IndicatorsController@update')->name('indikator.update');
                Route::delete('/hapus/{id}', 'IndicatorsController@destroy')->name('indikator.hapus');
            });

            // Penilaian Kinerja
            Route::prefix('penilaian_kinerja')->group(function () {
                Route::get('/', 'PenilaianController@index')->name('penilaian_kinerja.index');
                Route::get('/create', 'PenilaianController@create')->name('penilaian_kinerja.create');
                Route::post('/store', 'PenilaianController@store')->name('penilaian_kinerja.store');
                Route::get('/edit/{id}', 'PenilaianController@edit')->name('penilaian_kinerja.edit');
                Route::put('/update', 'PenilaianController@update')->name('penilaian_kinerja.update');
                Route::delete('/hapus/{id}', 'PenilaianController@destroy')->name('penilaian_kinerja.hapus');
            });


            // Akun
            Route::prefix('akun')->group(function () {
                Route::get('/', 'AkunController@index')->name('akun.index');
                Route::get('/create', 'AkunController@create')->name('akun.create');
                Route::post('/store', 'AkunController@store')->name('akun.store');
                Route::post('/regis', 'AkunController@regis')->name('akun.regis');
                Route::get('/edit/{id}', 'AkunController@edit')->name('akun.edit');
                Route::put('/update', 'AkunController@update')->name('akun.update');
                Route::post('/hapus/{id}', 'AkunController@destroy')->name('akun.hapus');
            });


            // Agenda
            Route::prefix('agenda')->group(function () {
                Route::get('/', 'AgendaController@index')->name('agenda.index');
                Route::get('/create', 'AgendaController@create')->name('agenda.create');
                Route::post('/store', 'AgendaController@store')->name('agenda.store');
                Route::get('/edit/{id}', 'AgendaController@edit')->name('agenda.edit');
                Route::put('/update', 'AgendaController@update')->name('agenda.update');
                Route::post('/hapus/{id}', 'AgendaController@destroy')->name('agenda.hapus');
            });

            // Absensi
            Route::prefix('absensi')->group(function () {
                Route::get('/', 'AbsensiController@index')->name('absensi.index');
                Route::get('/create', 'AbsensiController@create')->name('absensi.create');
                Route::post('/store', 'AbsensiController@store')->name('absensi.store');
                Route::get('/edit/{id}', 'AbsensiController@edit')->name('absensi.edit');
                Route::put('/update', 'AbsensiController@update')->name('absensi.update');
                Route::post('/hapus/{id}', 'AbsensiController@destroy')->name('absensi.hapus');
            });

            // Jadwal
            Route::prefix('jadwal')->group(function () {
                Route::get('/', 'JadwalController@index')->name('jadwal.index');
                Route::get('/create', 'JadwalController@create')->name('jadwal.create');
                Route::post('/store', 'JadwalController@store')->name('jadwal.store');
                Route::get('/edit/{id}', 'JadwalController@edit')->name('jadwal.edit');
                Route::put('/update', 'JadwalController@update')->name('jadwal.update');
                Route::post('/hapus/{id}', 'JadwalController@destroy')->name('jadwal.hapus');


 
            });

            Route::prefix('jdwl')->group(function () {

                //User jadwal mengajar
                Route::get('/', [JadwalController::class, 'index'])->name('user.jadwal.index');
                Route::get('/edit/{id}', [JadwalController::class, 'edit'])->name('user.jadwal.edit');
                Route::put('/store', [JadwalController::class, 'update'])->name('user.jadwal.update');
            });



            Route::prefix('user')->group(function () {
                //absensi
                Route::get('/', [AbsenController::class, 'userIndex'])->name('user.absensi.index');
                Route::get('/create', [AbsenController::class, 'userCreate'])->name('user.absensi.create');
                Route::post('/store', [AbsenController::class, 'userStore'])->name('user.absensi.store');


            });



        });
    }
);

// Auth
Route::group(['prefix' => 'auth', 'namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'AuthController@login')->name('login');
    // Route::get('/reset', 'AuthController@reset')->name('reset');
    // Route::get('/reset_password', 'AuthController@reset_password')->name('reset.password');
    Route::post('/login', 'AuthController@login_action')->name('login_action');
    Route::get('/logout', function () {
        Session::flush();
        return redirect()->route(
            'user.index'
        )->with('message', 'sukses logout');
    })->name('logout');
});

