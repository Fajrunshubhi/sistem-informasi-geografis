@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/data/kondisi-kesehatan">Kondisi Kesehatan Masyarakat</a>
    </h4>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible col-sm-8" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tabel Data Kondisi Kesehatan Masyarakat</h5>
            <div class="my-3 me-4 list-btn-data">
                <a href="/admin/data/kondisi-kesehatan/create" class="btn btn-primary btn-tambah-data">Tambah Data</a>
                <button type="button" class="btn btn-success ms-1">Export</button>
            </div>
        </div>
        <div class="table-responsive px-2">
            <table id="myTable" class="table table-hover align-middle table-responsive" style="width:175%">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Desa</th>
                        <th class="text-white">Penyakit</th>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Umur</th>
                        <th class="text-white">Jenis Kelamin</th>
                        <th class="text-white">No HP</th>
                        <th class="text-white">Alamat</th>
                        <th class="text-white">Waktu</th>
                        <th class="text-white">Latitude</th>
                        <th class="text-white">Longitude</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kondisi_kesehatan as $data)
                    @php
                    // Menggunakan Carbon untuk memformat tanggal
                    $tanggal = \Carbon\Carbon::parse($data->waktu_terdeteksi);
                    $hari = $tanggal->translatedFormat('l'); // Hari dalam Bahasa Indonesia
                    $bulan = $tanggal->translatedFormat('F'); // Bulan dalam Bahasa Indonesia
                    $tanggalFormatted = $tanggal->format('d'); // Tanggal dalam format angka
                    $tahun = $tanggal->format('Y'); // Tahun dalam format angka
                    $jam = $tanggal->format('H:i'); // Jam mulai dalam format 24 jam
                    @endphp
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->pasien->desa->nama_desa }}</td>
                        <td>{{ $data->penyakit->nama_penyakit }}</td>
                        <td>{{ $data->pasien->nama }}</td>
                        <td>{{ $data->pasien->umur }} Tahun</td>
                        <td>{{ $data->pasien->jenis_kelamin }}</td>
                        <td>{{ $data->pasien->no_tlpn }}</td>
                        <td>{{ $data->pasien->alamat }}</td>
                        <td>{{ $hari }}, <br> {{ $tanggalFormatted }} {{ $bulan }} {{ $tahun }} <br> {{ $jam }}
                        </td>
                        <td>{{ $data->latitude }}</td>
                        <td>{{ $data->longitude }}</td>
                        <td>
                            @can('is_adminDesa', $data->pasien->desa)
                            <div class="container-aksi align-items-center">
                                <a href="/admin/data/kondisi-kesehatan/{{ $data->id }}/edit"
                                    class="badge bg-warning d-block mb-2"><i
                                        class="bi bi-pencil-square me-1"></i>Edit</a>
                                <form action="/admin/data/kondisi-kesehatan/{{ $data->id }}" method="POST">
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
                    @endforeach
                </tbody>
                <tfoot class="bg-primary">
                    <tr>
                        <th class="text-white">ID</th>
                        <th class="text-white">Desa</th>
                        <th class="text-white">Penyakit</th>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Umur</th>
                        <th class="text-white">Jenis Kelamin</th>
                        <th class="text-white">No HP</th>
                        <th class="text-white">Alamat</th>
                        <th class="text-white">Waktu</th>
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
                { "width": "1%" },
                null, 
                null, 
                null, 
                null, 
                null,
                null,
                { "width": "20%" },
                null,
                null,
                null,
                null,
            ]  
        });
    });
</script>
@endpush