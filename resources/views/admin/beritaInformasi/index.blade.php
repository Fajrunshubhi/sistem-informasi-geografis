@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> Berita dan Informasi Kesehatan
    </h4>
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tabel Data Berita dan Informasi Kesehatan</h5>
            <div class="my-3 me-4 list-btn-data">
                <a href="/admin/berita-informasi/create" class="btn btn-primary btn-tambah-data">Tambah Data</a>
                <button type="button" class="btn btn-success ms-1">Export</button>
            </div>
        </div>
        <div class="table-responsive px-2">
            <table id="myTable" class="table table-hover align-middle table-responsive" style="width:100%">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-white">User</th>
                        <th class="text-white">Role</th>
                        <th class="text-white">Judul</th>
                        <th class="text-white">Isi</th>
                        <th class="text-white">Gambar</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Fajrun Shubhi</td>
                        <td>Super Admin</td>
                        <td>Judul Berita dan Informasi Kesehatan</td>
                        <td>Isi judul berita dan informasi kesehatan</td>
                        <td>Gambar</td>
                        <td>
                            @can('is_adminDesa', $data->desa)
                            <div class="container-aksi align-items-center">
                                <a href="#" class="badge bg-warning d-block mb-2"><i
                                        class="bi bi-pencil-square"></i></a>
                                <form action="#" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0 w-100"><i class="bi bi-trash"
                                            onclick="return confirm('Are you sure?')"></i>
                                    </button>
                                </form>
                            </div>
                            @endcan
                        </td>
                    </tr>
                    <tr>
                        <td>Fajrun Shubhi</td>
                        <td>Super Admin</td>
                        <td>Judul Berita dan Informasi Kesehatan</td>
                        <td>Isi judul berita dan informasi kesehatan</td>
                        <td>Gambar</td>
                        <td>
                            <div class="container-aksi align-items-center">
                                <a href="#" class="badge bg-warning d-block mb-2"><i
                                        class="bi bi-pencil-square"></i></a>
                                <form action="#" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0 w-100"><i class="bi bi-trash"
                                            onclick="return confirm('Are you sure?')"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <tfoot class="bg-primary">
                    <tr>
                        <th class="text-white">User</th>
                        <th class="text-white">Role</th>
                        <th class="text-white">Judul</th>
                        <th class="text-white">Isi</th>
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
            columns: [ 
                null, 
                null, 
                { "width": "20%" }, 
                { "width": "25%" }, 
                null, 
                null,
            ]  
        });
    });
</script>
@endpush