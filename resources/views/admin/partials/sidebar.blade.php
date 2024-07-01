<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand justify-content-center">
        <a href="#" class="app-brand-link text-center pt-3">
            <h3>Kecamatan @if ($profil_kecamatan->nama)
                {{ $profil_kecamatan->nama }}
                @endif</h3>
        </a>
        <a href="javascript:void(0);"
            class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none py-2 px-2">
            <i class="bi bi-arrow-left align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a href="/admin/dashboard" class="menu-link">
                <i class="bi bi-speedometer2 menu-icon tf-icons"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>

        <!-- Data Kesehatan -->
        <li class="menu-item {{ Request::is('admin/data*') ? 'active' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="bi bi-journal-medical menu-icon tf-icons"></i>
                <div data-i18n="Layouts">Data Kesehatan</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('admin/data/pusat-kesehatan*') ? 'active' : '' }}">
                    <a href="/admin/data/pusat-kesehatan" class="menu-link">
                        <div data-i18n="Without menu">Pusat Kesehatan</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('admin/data/fasilitas-kesehatan*') ? 'active' : '' }}">
                    <a href="/admin/data/fasilitas-kesehatan" class="menu-link">
                        <div data-i18n="Without navbar">Fasilitas Kesehatan</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('admin/data/layanan-kesehatan*') ? 'active' : '' }}">
                    <a href="/admin/data/layanan-kesehatan" class="menu-link">
                        <div data-i18n="Container">Layanan Kesehatan</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('admin/data/kondisi-kesehatan*') ? 'active' : '' }}">
                    <a href="/admin/data/kondisi-kesehatan" class="menu-link">
                        <div data-i18n="Fluid">Kondisi Kesehatan</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('admin/data/kategori-fasilitas*') ? 'active' : '' }}">
                    <a href="/admin/data/kategori-fasilitas" class="menu-link">
                        <div data-i18n="Blank">Kategori Fasilitas</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ Request::is('admin/pasien*') ? 'active' : '' }}">
            <a href="/admin/pasien" class="menu-link">
                <i class="bi bi-person-vcard menu-icon tf-icons"></i>
                <div data-i18n="Analytics">Data Pasien</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('admin/penyakit*') ? 'active' : '' }}">
            <a href="/admin/penyakit" class="menu-link">
                <i class="bi bi-virus2 menu-icon tf-icons"></i>
                <div data-i18n="Analytics">Data Penyakit</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('admin/pemantauan*') ? 'active' : '' }}">
            <a href="/admin/pemantauan" class="menu-link">
                <i class="bi bi-clipboard2-pulse menu-icon tf-icons"></i>
                <div data-i18n="Analytics">Data Pemantauan</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('admin/laporan-kesehatan*') ? 'active' : '' }}">
            <a href="/admin/laporan-kesehatan" class="menu-link">
                <i class="bi bi-clipboard-data menu-icon tf-icons"></i>
                <div data-i18n="Analytics">Laporan Kesehatan</div>
            </a>
        </li>
        @can('is_superAdmin')
        <li class="menu-item {{ Request::is('admin/desa*') ? 'active' : '' }}">
            <a href="/admin/desa" class="menu-link">
                <i class="bi bi-houses menu-icon tf-icons"></i>
                <div data-i18n="Analytics">Desa</div>
            </a>
        </li>
        @endcan
        <li class="menu-item {{ Request::is('admin/berita-informasi*') ? 'active' : '' }}">
            <a href="/admin/berita-informasi" class="menu-link">
                <i class="bi bi-newspaper menu-icon tf-icons"></i>
                <div data-i18n="Analytics">Berita dan Informasi </div>
            </a>
        </li>
        @can('is_superAdmin')
        <li class="menu-item {{ Request::is('admin/profil-kecamatan*') ? 'active' : '' }}">
            <a href="/admin/profil-kecamatan" class="menu-link">
                <i class="bi bi-person-lines-fill menu-icon tf-icons"></i>
                <div data-i18n="Analytics">Profil Kecamatan</div>
            </a>
        </li>
        @endcan

        @can('is_superAdmin')
        <li class="menu-item {{ Request::is('admin/user*') ? 'active' : '' }}">
            <a href="/admin/user" class="menu-link">
                <i class="bi bi-people menu-icon tf-icons"></i>
                <div data-i18n="Analytics">Users</div>
            </a>
        </li>
        @endcan
    </ul>
</aside>