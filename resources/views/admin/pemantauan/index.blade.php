@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/pemantauan">Pemantauan Penyakit</a>
    </h4>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible col-sm-8" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tabel Data Pemantauan Penyakit</h5>
            <div class="my-3 me-4 list-btn-data">
                <a href="/admin/pemantauan/create" class="btn btn-primary btn-tambah-data">Tambah Data</a>
                <a href="{{ route('pemantauan.export') }}" class="btn btn-success ms-1 text-white">Export</a>
            </div>
        </div>
        <div class="table-responsive px-2">
            <table id="myTable" class="table table-hover align-middle table-responsive" style="width: 175%">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-white"></th>
                        <th class="text-white">Desa</th>
                        <th class="text-white">Penyakit</th>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Umur</th>
                        <th class="text-white">Jenis Kelamin</th>
                        <th class="text-white">No HP</th>
                        <th class="text-white">Alamat</th>
                        <th class="text-white">Waktu</th>
                        <th class="text-white">Keterangan</th>
                        <th class="text-white">Keparahan</th>
                        <th class="text-white">Latitude</th>
                        <th class="text-white">Longitude</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemantauan as $data)
                    @php
                    // Menggunakan Carbon untuk memformat tanggal
                    $tanggal = \Carbon\Carbon::parse($data->waktu_layanan);
                    $hari = $tanggal->translatedFormat('l'); // Hari dalam Bahasa Indonesia
                    $bulan = $tanggal->translatedFormat('F'); // Bulan dalam Bahasa Indonesia
                    $tanggalFormatted = $tanggal->format('d'); // Tanggal dalam format angka
                    $tahun = $tanggal->format('Y'); // Tahun dalam format angka
                    $jam = $tanggal->format('H:i'); // Jam mulai dalam format 24 jam
                    @endphp
                    <tr>
                        <td>
                            <!-- View Icon with data-toggle and data-target attributes to trigger the modal -->
                            <a href="#" class="text-primary" data-bs-toggle="modal"
                                data-bs-target="#viewModal{{ $data->id }}">
                                <i class="bi bi-eye-fill fs-4"></i>
                            </a>
                        </td>
                        <td>{{ $data->kondisi_kesehatan->pasien->desa->nama_desa }}</td>
                        <td>{{ $data->kondisi_kesehatan->penyakit->nama_penyakit }}</td>
                        <td>{{ $data->kondisi_kesehatan->pasien->nama }}</td>
                        <td>{{ $data->kondisi_kesehatan->pasien->umur }} Tahun</td>
                        <td>{{ $data->kondisi_kesehatan->pasien->jenis_kelamin }}</td>
                        <td>{{ $data->kondisi_kesehatan->pasien->no_tlpn }}</td>
                        <td>{{ $data->kondisi_kesehatan->pasien->alamat }}</td>
                        <td>{{ $hari }}, <br> {{ $tanggalFormatted }} {{ $bulan }} {{ $tahun }} <br> {{ $jam }}</td>
                        <td>{{ $data->keterangan }}</td>
                        <td>{{ $data->tingkat_keparahan }}</td>
                        <td>{{ $data->kondisi_kesehatan->latitude }}</td>
                        <td>{{ $data->kondisi_kesehatan->longitude }}</td>
                        <td>
                            @can('is_adminDesa', $data->kondisi_kesehatan->pasien->desa)
                            <div class="container-aksi align-items-center">
                                <a href="/admin/pemantauan/{{ $data->id }}/edit"
                                    class="badge bg-warning d-block mb-2"><i
                                        class="bi bi-pencil-square me-1"></i>Edit</a>
                                <form action="/admin/pemantauan/{{ $data->id }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0 w-100"
                                        onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i
                                            class="bi bi-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                            @endcan
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="viewModal{{ $data->id }}" tabindex="-1"
                        aria-labelledby="viewModalLabel{{ $data->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModalLabel{{ $data->id }}">Detail Pemantauan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Desa</strong></div>
                                            <div class="col-6">: {{ $data->kondisi_kesehatan->pasien->desa->nama_desa }}
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Penyakit</strong></div>
                                            <div class="col-6">: {{ $data->kondisi_kesehatan->penyakit->nama_penyakit }}
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Nama Pasien</strong></div>
                                            <div class="col-6">: {{ $data->kondisi_kesehatan->pasien->nama }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Umur</strong></div>
                                            <div class="col-6">: {{ $data->kondisi_kesehatan->pasien->umur }} Tahun
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Jenis Kelamin</strong></div>
                                            <div class="col-6">: {{ $data->kondisi_kesehatan->pasien->jenis_kelamin }}
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>No HP</strong></div>
                                            <div class="col-6">: {{ $data->kondisi_kesehatan->pasien->no_tlpn }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Alamat</strong></div>
                                            <div class="col-6">: {{ $data->kondisi_kesehatan->pasien->alamat }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Waktu Layanan</strong></div>
                                            <div class="col-6">: {{ $hari }}, {{ $tanggalFormatted }} {{ $bulan }} {{
                                                $tahun }} Pukul {{ $jam }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Keterangan</strong></div>
                                            <div class="col-6">: {{ $data->keterangan }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Tingkat Keparahan</strong></div>
                                            <div class="col-6">: {{ $data->tingkat_keparahan }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Latitude</strong></div>
                                            <div class="col-6">: {{ $data->kondisi_kesehatan->latitude }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Longitude</strong></div>
                                            <div class="col-6">: {{ $data->kondisi_kesehatan->longitude }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="container d-flex justify-between align-items-center">
                                        <div class="aksi">
                                            @can('is_adminDesa', $data->kondisi_kesehatan->pasien->desa)
                                            <div class="container-aksi d-flex">
                                                <a href="/admin/pemantauan/{{ $data->id }}/edit"
                                                    class="badge bg-warning d-block me-2">
                                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                                </a>
                                                <form action="/admin/pemantauan/{{ $data->id }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="badge bg-danger border-0 w-100"
                                                        onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                                        <i class="bi bi-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                            @endcan
                                        </div>
                                        <div class="tutup">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </tbody>
                <tfoot class="bg-primary">
                    <tr>
                        <th class="text-white"></th>
                        <th class="text-white">Desa</th>
                        <th class="text-white">Penyakit</th>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Umur</th>
                        <th class="text-white">Jenis Kelamin</th>
                        <th class="text-white">No HP</th>
                        <th class="text-white">Alamat</th>
                        <th class="text-white">Waktu</th>
                        <th class="text-white">Keterangan</th>
                        <th class="text-white">Keparahan</th>
                        <th class="text-white">Latitude</th>
                        <th class="text-white">Longitude</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready( function () {
        $('#myTable').DataTable({
            scrollX: true,
            autoWidth: false,
            columns: [ 
                null,
                { "width": "6%" }, 
                { "width": "7%" }, 
                { "width": "6%" }, 
                { "width": "5%" }, 
                { "width": "8%" },
                { "width": "5%" },
                { "width": "14%" },
                { "width": "8%" },
                { "width": "14%" },
                { "width": "5%" },
                { "width": "5%" },
                { "width": "5%" },
                { "width": "5%" },
            ] 
        });
    });
</script>
@endpush