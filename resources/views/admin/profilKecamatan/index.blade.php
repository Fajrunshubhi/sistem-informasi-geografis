@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/profil-kecamatan">Profil Kecamatan</a>
    </h4>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible col-sm-8" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tabel Data Profil Kecamatan</h5>
            <div class="my-3 me-4 list-btn-data">
                <a href="{{ route('profil.kecamatan.export') }}" class="btn btn-success ms-1 text-white">Export</a>
            </div>
        </div>
        <div class="table-responsive px-2">
            <table id="myTable" class="table table-hover align-middle table-responsive" style="width:100%">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-white"></th>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Email</th>
                        <th class="text-white">No HP</th>
                        <th class="text-white">Deskripsi</th>
                        <th class="text-white">Alamat</th>
                        <th class="text-white">Latitude</th>
                        <th class="text-white">Longitude</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <!-- View Icon with data-toggle and data-target attributes to trigger the modal -->
                            <a href="#" class="text-primary" data-bs-toggle="modal"
                                data-bs-target="#viewModal{{ $profil_kecamatan->id }}">
                                <i class="bi bi-eye-fill fs-4"></i>
                            </a>
                        </td>
                        <td>{{ $profil_kecamatan->nama }}</td>
                        <td>{{ $profil_kecamatan->email }}</td>
                        <td>{{ $profil_kecamatan->no_tlpn }}</td>
                        <td>{{ (str_word_count($profil_kecamatan->deskripsi) > 10 ?
                            substr($profil_kecamatan->deskripsi,0,75)."..."
                            : $profil_kecamatan->deskripsi)
                            }}</td>
                        <td>{{ $profil_kecamatan->alamat }}</td>
                        <td>{{ $profil_kecamatan->latitude }}</td>
                        <td>{{ $profil_kecamatan->longitude }}</td>
                        <td>
                            <div class="container-aksi align-items-center">
                                <a href="/admin/profil-kecamatan/{{ $profil_kecamatan->id }}/edit"
                                    class="badge bg-warning d-block mb-2"><i
                                        class="bi bi-pencil-square me-1"></i>Edit</a>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="viewModal{{ $profil_kecamatan->id }}" tabindex="-1"
                        aria-labelledby="viewModalLabel{{ $profil_kecamatan->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModalLabel{{ $profil_kecamatan->id }}">Detail Profil
                                        Kecamatan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Nama</strong></div>
                                            <div class="col-6">: {{ $profil_kecamatan->nama }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Email</strong></div>
                                            <div class="col-6">: {{ $profil_kecamatan->email }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>No Telepon</strong></div>
                                            <div class="col-6">: {{ $profil_kecamatan->no_tlpn }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Deskripsi</strong></div>
                                            <div class="col-6">: {{ (str_word_count($profil_kecamatan->deskripsi) > 10 ?
                                                substr($profil_kecamatan->deskripsi,0,75)."..."
                                                : $profil_kecamatan->deskripsi)
                                                }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Alamat</strong></div>
                                            <div class="col-6">: {{ $profil_kecamatan->alamat }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Latitude</strong></div>
                                            <div class="col-6">: {{ $profil_kecamatan->latitude }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Longitude</strong></div>
                                            <div class="col-6">: {{ $profil_kecamatan->longitude }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="container d-flex justify-between align-items-center">
                                        <div class="aksi">
                                            <div class="container-aksi d-flex">
                                                <a href="/admin/profil-kecamatan/{{ $profil_kecamatan->id }}/edit"
                                                    class="badge bg-warning d-block mb-2"><i
                                                        class="bi bi-pencil-square me-1"></i>Edit</a>
                                            </div>
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

                </tbody>
                <tfoot class="bg-primary">
                    <tr>
                        <th class="text-white"></th>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Email</th>
                        <th class="text-white">No HP</th>
                        <th class="text-white">Deskripsi</th>
                        <th class="text-white">Alamat</th>
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
            columns: [ 
                null,
                null, 
                null, 
                null, 
                { "width": "20%" }, 
                { "width": "20%" }, 
                null,
                null,
                null,
            ]  
        });
    });
</script>
@endpush