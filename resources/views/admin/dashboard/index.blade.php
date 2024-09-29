@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Dashboard</h4>
    <div class="row mb-2">
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-dashboard-1 h-100">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-dashboard"><i
                                    class="bi bi-journal-medical  menu-icon tf-icons mx-auto"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">{{ $totalPusatKesehatan }}</h4>
                    </div>
                    <h5 class="mb-3">Pusat Kesehatan</h5>
                    <a href="/admin/data/pusat-kesehatan">
                        <p class="mb-0 text-center bg-dashboard py-1 rounded-md">
                            <span class="fw-medium me-1 text-white">Selengkapnya <i
                                    class="bi bi-arrow-right ms-2"></i></span>
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-dashboard-1 h-100">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-dashboard"><i
                                    class="bi bi-journal-medical  menu-icon tf-icons mx-auto"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">{{ $totalFasilitasKesehatan }}</h4>
                    </div>
                    <h5 class="mb-3">Fasilitas Kesehatan</h5>
                    <a href="/admin/data/fasilitas-kesehatan">
                        <p class="mb-0 text-center bg-dashboard py-1 rounded-md">
                            <span class="fw-medium me-1 text-white">Selengkapnya <i
                                    class="bi bi-arrow-right ms-2"></i></span>
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-dashboard-1 h-100">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-dashboard"><i
                                    class="bi bi-journal-medical menu-icon tf-icons mx-auto"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">{{ $totalLayananKesehatan }}</h4>
                    </div>
                    <h5 class="mb-3">Layanan Kesehatan</h5>
                    <a href="/admin/data/layanan-kesehatan">
                        <p class="mb-0 text-center bg-dashboard py-1 rounded-md">
                            <span class="fw-medium me-1 text-white">Selengkapnya <i
                                    class="bi bi-arrow-right ms-2"></i></span>
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-dashboard-1 h-100">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-dashboard"><i
                                    class="bi bi-journal-medical menu-icon tf-icons mx-auto"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">{{ $totalKondisiKesehatan }}</h4>
                    </div>
                    <h5 class="mb-3">Kondisi Kesehatan</h5>
                    <a href="/admin/data/kondisi-kesehatan">
                        <p class="mb-0 text-center bg-dashboard py-1 rounded-md">
                            <span class="fw-medium me-1 text-white">Selengkapnya <i
                                    class="bi bi-arrow-right ms-2"></i></span>
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-dashboard-5 h-100">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-dashboard-pasien2"><i
                                    class="bi bi-person-vcard menu-icon tf-icons mx-auto"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">{{ $totalPasien }}</h4>
                    </div>
                    <h5 class="mb-3">Pasien</h5>
                    <a href="/admin/pasien">
                        <p class="mb-0 text-center bg-dashboard-pasien1 py-1 rounded-md">
                            <span class="fw-medium me-1 text-white">Selengkapnya <i
                                    class="bi bi-arrow-right ms-2"></i></span>
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-dashboard-6 h-100">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-dashboard-penyakit2"><i
                                    class="bi bi-virus2 menu-icon tf-icons tx-dashboard-penyakit1 mx-auto"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">{{ $totalPenyakit }}</h4>
                    </div>
                    <h5 class="mb-3">Penyakit</h5>
                    <a href="/admin/penyakit">
                        <p class="mb-0 text-center bg-dashboard-penyakit1 py-1 rounded-md">
                            <span class="fw-medium me-1 text-white">Selengkapnya <i
                                    class="bi bi-arrow-right ms-2"></i></span>
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-dashboard-7 h-100">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-dashboard-pemantauan2"><i
                                    class="bi bi-clipboard2-pulse menu-icon tf-icons tx-dashboard-pemantauan1 mx-auto"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">{{ $totalPemantauan }}</h4>
                    </div>
                    <h5 class="mb-3">Pemantauan</h5>
                    <a href="/admin/pemantauan">
                        <p class="mb-0 text-center bg-dashboard-pemantauan1 py-1 rounded-md">
                            <span class="fw-medium me-1 text-white">Selengkapnya <i
                                    class="bi bi-arrow-right ms-2"></i></span>
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-dashboard-8 h-100">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-dashboard-laporankesehatan2"><i
                                    class="bi bi-clipboard-data menu-icon tf-icons tx-dashboard-laporankesehatan1 mx-auto"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">{{ $totalLaporanKesehatan }}</h4>
                    </div>
                    <h5 class="mb-3">Laporan Kesehatan</h5>
                    <a href="/admin/laporan-kesehatan">
                        <p class="mb-0 text-center bg-dashboard-laporankesehatan1 py-1 rounded-md">
                            <span class="fw-medium me-1 text-white">Selengkapnya <i
                                    class="bi bi-arrow-right ms-2"></i></span>
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2 justify-center">
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-dashboard-9 h-100">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-dashboard-berita2"><i
                                    class="bi bi-newspaper menu-icon tf-icons tx-dashboard-berita1 mx-auto"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">{{ $totalBerita }}</h4>
                    </div>
                    <h5 class="mb-3">Berita dan Informasi</h5>
                    <a href="/admin/berita-informasi">
                        <p class="mb-0 text-center bg-dashboard-berita1 py-1 rounded-md">
                            <span class="fw-medium me-1 text-white">Selengkapnya <i
                                    class="bi bi-arrow-right ms-2"></i></span>
                        </p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-dashboard-10 h-100">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-dashboard-user2"><i
                                    class="bi bi-newspaper menu-icon tf-icons tx-dashboard-user1 mx-auto"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0">{{ $totalUser }}</h4>
                    </div>
                    <h5 class="mb-3">Users</h5>
                    <a href="/admin/user">
                        <p class="mb-0 text-center bg-dashboard-user1 py-1 rounded-md">
                            <span class="fw-medium me-1 text-white">Selengkapnya <i
                                    class="bi bi-arrow-right ms-2"></i></span>
                        </p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div style="width: 100%;">
                <canvas id="pusat-kesehatan"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('pusat-kesehatan');

        // Memproses data dari PHP ke format yang dibutuhkan oleh Chart.js
        var chartData = {
            labels: {!! $dataChart->map(function($item) {
                    return \Carbon\Carbon::createFromDate($item->year, $item->month)->format('M Y');
                }) !!},
            datasets: [{
                label: 'Number of Health Centers',
                data: {!! $dataChart->pluck('count') !!},
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false
            }]
        };

        var chartPusatKesehatan = new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0,
                        suggestedMax: {!! $dataChart->max('count') + 1 !!}
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    });
</script>
@endsection