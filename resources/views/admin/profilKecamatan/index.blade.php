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
                </tbody>
                <tfoot class="bg-primary">
                    <tr>
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