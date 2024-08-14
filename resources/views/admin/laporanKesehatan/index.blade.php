@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/laporan-kesehatan">Laporan Kesehatan</a>
    </h4>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible col-sm-8" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tabel Data Laporan Kesehatan</h5>
            <div class="my-3 me-4 list-btn-data">
                <a href="/admin/laporan-kesehatan/create" class="btn btn-primary btn-tambah-data">Tambah Data</a>
                <a href="{{ route('laporan.kesehatan.export') }}" class="btn btn-success ms-1 text-white">Export</a>
            </div>
        </div>
        <div class="table-responsive px-2">
            <table id="myTable" class="table table-hover align-middle table-responsive" style="width:100%">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-white"></th>
                        <th class="text-white">Desa</th>
                        <th class="text-white">Judul</th>
                        <th class="text-white">Deskripsi</th>
                        <th class="text-white">File</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($laporan_kesehatan as $data)
                    <tr>
                        <td>
                            <!-- View Icon with data-toggle and data-target attributes to trigger the modal -->
                            <a href="#" class="text-primary" data-bs-toggle="modal"
                                data-bs-target="#viewModal{{ $data->id }}">
                                <i class="bi bi-eye-fill fs-4"></i>
                            </a>
                        </td>
                        <td>{{ $data->desa->nama_desa }}</td>
                        <td>{{ $data->judul_laporan }}</td>
                        <td>{{ (str_word_count($data->deskripsi) > 10 ?
                            substr($data->deskripsi,0,75)."..."
                            : $data->deskripsi)
                            }}</td>
                        <td><a href="{{ asset('storage/' . $data->file) }}" target="_blank">{{ $data->file }}</a></td>
                        <td class="align-middle">
                            @can('is_adminDesa', $data->desa)
                            <div class="container-aksi align-items-center">
                                <a href="/admin/laporan-kesehatan/{{ $data->id }}/edit"
                                    class="badge bg-warning d-block mb-2"><i
                                        class="bi bi-pencil-square me-1"></i>Edit</a>
                                <form action="/admin/laporan-kesehatan/{{ $data->id }}" method="POST">
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
                                    <h5 class="modal-title" id="viewModalLabel{{ $data->id }}">Detail Pusat Kesehatan
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row mb-2">
                                                <div class="col-6"><strong>Desa</strong></div>
                                                <div class="col-6">: {{ $data->desa->nama_desa }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6"><strong>Judul Laporan</strong></div>
                                                <div class="col-6">: {{ $data->judul_laporan }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6"><strong>Deskripsi</strong></div>
                                                <div class="col-6">: {!! $data->deskripsi !!}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6"><strong>File</strong></div>
                                                <div class="col-6">: <a href="{{ asset('storage/' . $data->file) }}"
                                                        target="_blank">{{ $data->file }}</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="container d-flex justify-between align-items-center">
                                        <div class="aksi">
                                            @can('is_adminDesa', $data->desa)
                                            <div class="container-aksi d-flex">
                                                <a href="/admin/laporan-kesehatan/{{ $data->id }}/edit"
                                                    class="badge bg-warning d-block me-2">
                                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                                </a>
                                                <form action="/admin/laporan-kesehatan/{{ $data->id }}" method="POST">
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
                        <th class="text-white">Judul</th>
                        <th class="text-white">Deskripsi</th>
                        <th class="text-white">File</th>
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
            columns: [ 
                null,
                null, 
                {"width" : "20%"}, 
                {"width" : "30%"}, 
                null, 
                null,
            ]  
        });
    });
</script>
@endpush