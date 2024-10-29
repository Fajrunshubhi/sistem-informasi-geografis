@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/pasien">Data Pasien</a>
    </h4>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible col-sm-8" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tabel Data Pasien</h5>
            <div class="my-3 me-4 list-btn-data">
                <a href="/admin/pasien/create" class="btn btn-primary btn-tambah-data">Tambah Data</a>
                <a href="{{ route('pasien.export') }}" class="btn btn-success ms-1 text-white">Export</a>
            </div>
        </div>
        <div class="table-responsive px-2">
            <table id="myTable" class="table table-hover align-middle table-responsive"
                style="width:100%; font-size: 14px;">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-white"></th>
                        <th class="text-white">ID</th>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Desa</th>
                        <th class="text-white">Umur</th>
                        <th class="text-white">Jenis Kelamin</th>
                        <th class="text-white">No HP</th>
                        <th class="text-white">Alamat</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasien as $data)
                    <tr>
                        <td>
                            <!-- View Icon with data-toggle and data-target attributes to trigger the modal -->
                            <a href="#" class="text-primary" data-bs-toggle="modal"
                                data-bs-target="#viewModal{{ $data->id }}">
                                <i class="bi bi-eye-fill fs-4"></i>
                            </a>
                        </td>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->desa->nama_desa }}</td>
                        <td>{{ $data->umur }} Tahun</td>
                        <td>{{ $data->jenis_kelamin }}</td>
                        <td>{{ $data->no_tlpn }}</td>
                        <td>{{ $data->alamat }} </td>
                        <td>
                            @can('is_adminDesa', $data->desa)
                            <div class="container-aksi align-items-center">
                                <a href="/admin/pasien/{{ $data->id }}/edit" class="badge bg-warning d-block mb-2"><i
                                        class="bi bi-pencil-square me-1"></i>Edit</a>
                                <form id="delete-form-{{ $data->id }}" action="/admin/pasien/{{ $data->id }}"
                                    method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="button" class="badge bg-danger border-0 w-100"
                                        onclick="confirmDelete('{{ $data->id }}')"><i class="bi bi-trash me-1"></i>Hapus
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
                                    <h5 class="modal-title" id="viewModalLabel{{ $data->id }}">Detail Data Pasien
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>NIK</strong></div>
                                            <div class="col-6">: {{ $data->id }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Nama</strong></div>
                                            <div class="col-6">: {{ $data->nama }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Desa</strong></div>
                                            <div class="col-6">: {{ $data->desa->nama_desa }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Umur</strong></div>
                                            <div class="col-6">: {{ $data->umur }} Tahun</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Jenis Kelamin</strong></div>
                                            <div class="col-6">: {{ $data->jenis_kelamin }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>No HP</strong></div>
                                            <div class="col-6">: {{ $data->no_tlpn }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Alamat</strong></div>
                                            <div class="col-6">: {{ $data->alamat }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="container d-flex justify-between align-items-center">
                                        <div class="aksi">
                                            @can('is_adminDesa', $data->desa)
                                            <div class="container-aksi d-flex">
                                                <a href="/admin/pasien/{{ $data->id }}/edit"
                                                    class="badge bg-warning d-block me-2"><i
                                                        class="bi bi-pencil-square me-1"></i>Edit</a>
                                                <form id="delete-form-{{ $data->id }}"
                                                    action="/admin/pasien/{{ $data->id }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="button" class="badge bg-danger border-0 w-100"
                                                        onclick="confirmDelete('{{ $data->id }}')"><i
                                                            class="bi bi-trash me-1"></i>Hapus
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
                        <th class="text-white">ID</th>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Desa</th>
                        <th class="text-white">Umur</th>
                        <th class="text-white">Jenis Kelamin</th>
                        <th class="text-white">No HP</th>
                        <th class="text-white">Alamat</th>
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
                { "width": "20%" }, 
                null, 
                { "width": "15%" }, 
                { "width": "20%" },
                null,
                { "width": "30%" },
                null,
            ]  
        });
    });
</script>
@endpush