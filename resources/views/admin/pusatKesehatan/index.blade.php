@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/data/pusat-kesehatan">Pusat Kesehatan</a>
    </h4>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible col-sm-8" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tabel Data Pusat Kesehatan</h5>
            <div class="my-3 me-4 list-btn-data">
                <a href="/admin/data/pusat-kesehatan/create" class="btn btn-primary btn-tambah-data">Tambah Data</a>
                <a href="{{ route('pusat.kesehatan.export') }}" class="btn btn-success ms-1 text-white">Export</a>
            </div>
        </div>
        <div class="table-responsive px-2">
            <table id="myTable" class="table table-hover align-middle table-responsive" style="width:120%">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-white"></th>
                        <th class="text-white">Desa</th>
                        <th class="text-white">Nama</th>
                        <th class="text-white">No HP</th>
                        <th class="text-white">Alamat</th>
                        <th class="text-white">Latitude</th>
                        <th class="text-white">Longitude</th>
                        <th class="text-white">Gambar</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pusat_kesehatan as $data)
                    <tr>
                        <td>
                            <!-- View Icon with data-toggle and data-target attributes to trigger the modal -->
                            <a href="#" class="text-primary" data-bs-toggle="modal"
                                data-bs-target="#viewModal{{ $data->id }}">
                                <i class="bi bi-eye-fill fs-4"></i>
                            </a>
                        </td>
                        <td>{{ $data->desa->nama_desa }}</td>
                        <td>{{ $data->nama_pusat_kesehatan }}</td>
                        <td>{{ $data->no_tlpn }}</td>
                        <td>{{ $data->alamat }}</td>
                        <td>{{ $data->latitude }}</td>
                        <td>{{ $data->longitude }}</td>
                        <td class="p-0">
                            <div class="w-75" style="max-height: 350px; overflow: hidden;">
                                <img src="{{ asset('storage/'.$data->gambar) }}" alt="{{ $data->nama_pusat_kesehatan }}"
                                    class="img-fluid my-2">
                            </div>
                        </td>
                        <td>
                            @can('is_adminDesa', $data->desa)
                            <div class="container-aksi align-items-center">
                                <a href="/admin/data/pusat-kesehatan/{{ $data->id }}/edit"
                                    class="badge bg-warning d-block mb-2"><i
                                        class="bi bi-pencil-square me-1"></i>Edit</a>
                                <form id="delete-form-{{ $data->id }}"
                                    action="/admin/data/pusat-kesehatan/{{ $data->id }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="button" class="badge bg-danger border-0 w-100"
                                        onclick="confirmDelete('{{ $data->id }}')"><i class="bi bi-trash"></i> Hapus
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
                                                <div class="col-6"><strong>Nama Pusat Kesehatan</strong></div>
                                                <div class="col-6">: {{ $data->nama_pusat_kesehatan }}</div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-6"><strong>No HP</strong></div>
                                                <div class="col-6">: {{ $data->no_tlpn }}</div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-6"><strong>Alamat</strong></div>
                                                <div class="col-6">: {{ $data->alamat }}</div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-6"><strong>Latitude</strong></div>
                                                <div class="col-6">: {{ $data->latitude }}</div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-6"><strong>Longitude</strong></div>
                                                <div class="col-6">: {{ $data->longitude }}</div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-12">
                                                    <div class="w-100 d-flex justify-center">
                                                        <img src="{{ asset('storage/'.$data->gambar) }}"
                                                            alt="{{ $data->nama_pusat_kesehatan }}"
                                                            class="img-fluid w-75">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="container d-flex justify-between align-items-center">
                                        <div class="aksi">
                                            @can('is_adminDesa', $data->desa)
                                            <div class="container-aksi d-flex">
                                                <a href="/admin/data/pusat-kesehatan/{{ $data->id }}/edit"
                                                    class="badge bg-warning d-block me-2"><i
                                                        class="bi bi-pencil-square me-1"></i>Edit</a>
                                                <form id="delete-form-{{ $data->id }}"
                                                    action="/admin/data/pusat-kesehatan/{{ $data->id }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="button" class="badge bg-danger border-0 w-100"
                                                        onclick="confirmDelete('{{ $data->id }}')"><i
                                                            class="bi bi-trash"></i> Hapus
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
                        <th class="text-white">Nama</th>
                        <th class="text-white">No HP</th>
                        <th class="text-white">Alamat</th>
                        <th class="text-white">Latitude</th>
                        <th class="text-white">Longitude</th>
                        <th class="text-white">Gambar</th>
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
                null, 
                { "width": "15%" }, 
                null, 
                { "width": "20%" }, 
                { "width": "10%" },
                { "width": "10%" },
                null,
                null,
            ] 
        });
    });
</script>
@endpush