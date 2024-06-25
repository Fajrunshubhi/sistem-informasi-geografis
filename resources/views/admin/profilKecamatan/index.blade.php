@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> Profil Kecamatan
    </h4>
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tabel Data Profil Kecamatan</h5>
            <div class="my-3 me-4 list-btn-data">
                <button type="button" class="btn btn-success ms-1">Export</button>
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
                        <td>Tunjungan</td>
                        <td>Fajrun@gmail.com</td>
                        <td>081227876535</td>
                        <td>Deskripsi Kecamatan</td>
                        <td>Jalan Tunjungan No. 10, RT 01 RW 02, Desa Tunjungan, Kecamatan Ngombol, Kab. Purworejo, Jawa
                            Tengah, </td>
                        <td>-7.835607</td>
                        <td>109.943748</td>
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