<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('dashboard') }}">DEKRANASDA SULSEL</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('dashboard') }}">UMKM</a>
        </div>

        <ul class="sidebar-menu">

            <li class="menu-header">Dashboard</li>

            <li class="nav-item  {{ $menu == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link "><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            @if (session('role') == 'admin')
                <li
                    class="nav-item dropdown {{ ($menu == 'umkm' || $menu == 'jenis_usaha' || $menu == 'pembinaan') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-sitemap"></i>
                        <span>Master Data</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="{{ $menu == 'umkm' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('umkm.index') }}">
                                UMKM
                            </a>
                        </li>
                        <li class="{{ $menu == 'jenis_usaha' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('jenis_usaha.index') }}">
                                Jenis Usaha
                            </a>
                        </li>
                        <li class="{{ $menu == 'pembinaan' ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pembinaan.index') }}">
                                Pembinaan
                            </a>
                        </li>
                    </ul>
                </li>



                <!-- <li class="{{ $menu == 'penilaian_kinerja' ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('penilaian_kinerja.index') }}">
                                            <i class="fas fa-wallet"></i> <span>Data Laporan Kinerja</span>
                                        </a>
                                    </li>
                     -->
                <!-- <li class="{{ $menu == 'absensi' ? 'active' : '' }}">
                                        <a class="nav-link" href="{{ route('absensi.index') }}">
                                            <i class="fas fa-wallet"></i> <span>Data Absen Rapat</span>
                                        </a>
                                    </li> -->


                <li class="{{ $menu == 'akun' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('akun.index') }}">
                        <i class="fas fa-user"></i> <span>Data Akun</span>
                    </a>
                </li>

                <li class="menu-header">Landing Page</li>

            @endif

            @if (session('role') == 'user')

                <li class="{{ $menu == 'umkm' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('umkm.index') }}">
                        <i class="fas fa-wallet"></i> <span>UMKM</span>
                    </a>
                </li>
                <li class="{{ $menu == 'pembinaan' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('pembinaan.index') }}">
                        <i class="fas fa-wallet"></i> <span>Pembinaan</span>
                    </a>
                </li>
                <li class="menu-header">Landing Page</li>

            @endif

            @if (session('role') == 'kepala_sekolah')

                <li class="{{ $menu == 'penilaian_kinerja' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('penilaian_kinerja.index') }}">
                        <i class="fas fa-wallet"></i> <span>Laporan Kinerja</span>
                    </a>
                </li>
                <li class="menu-header">Landing Page</li>

            @endif
        </ul>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ route('logout') }}" class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
</div>