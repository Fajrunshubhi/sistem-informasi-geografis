<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark border-bottom border-body py-3 rounded sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand fs-5 color-font-primary" href="/">SIG | Kecamatan @if ($profil_kecamatan->nama)
            {{ $profil_kecamatan->nama }}
            @else
            -
            @endif</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item ms-2  {{ Request::is('/') ? 'active fw-bold' : '' }}">
                    <a class="nav-link" aria-current="page" href="/">Beranda</a>
                </li>
                <li class="nav-item dropdown ms-2 {{ Request::is('sebaran*') ? 'active fw-bold' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Sebaran Kesehatan
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item {{ Request::is('sebaran/pusat-kesehatan') ? 'active fw-bold' : '' }}"
                                href="/sebaran/pusat-kesehatan">Sebaran Pusat Kesehatan</a></li>
                        <li><a class="dropdown-item {{ Request::is('sebaran/fasilitas-kesehatan') ? 'active fw-bold' : '' }}"
                                href="/sebaran/fasilitas-kesehatan">Sebaran Fasilitas Kesehatan</a></li>
                        <li><a class="dropdown-item {{ Request::is('sebaran/layanan-kesehatan') ? 'active fw-bold' : '' }}"
                                href="/sebaran/layanan-kesehatan">Sebaran Layanan Kesehatan</a></li>
                        <li><a class="dropdown-item {{ Request::is('sebaran/kondisi-kesehatan') ? 'active fw-bold' : '' }}"
                                href="/sebaran/kondisi-kesehatan">Sebaran Kondisi Kesehatan</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    </ul>
                </li>
                <li class="nav-item ms-2 {{ Request::is('pemantauan-penyakit') ? 'active fw-bold' : '' }}">
                    <a class="nav-link" href="/pemantauan-penyakit">Pemantauan Penyakit</a>
                </li>
                <li class="nav-item ms-2 {{ Request::is('laporan-kesehatan') ? 'active fw-bold' : '' }}">
                    <a class="nav-link" href="/laporan-kesehatan">Laporan Kesehatan</a>
                </li>
                <li class="nav-item ms-2 {{ Request::is('berita-informasi') ? 'active fw-bold' : '' }}">
                    <a class="nav-link" href="/berita-informasi">Berita dan Informasi</a>
                </li>
                <li class="nav-item ms-2 {{ Request::is('profil-kecamatan') ? 'active fw-bold' : '' }}">
                    <a class="nav-link" href="/profil-kecamatan">Profil</a>
                </li>
                <li class="nav-item ms-2 me-3 {{ Request::is('kontak') ? 'active fw-bold' : '' }}">
                    <a class="nav-link" href="/kontak">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary px-3" href="/login">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>