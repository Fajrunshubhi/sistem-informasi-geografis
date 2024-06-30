@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/desa">Desa</a>
    </h4>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible col-sm-8" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tabel Data Desa</h5>
            <div class="my-3 me-4 list-btn-data">
                <a href="/admin/desa/create" class="btn btn-primary btn-tambah-data">Tambah Data</a>
                <a href="{{ route('desa.export') }}" class="btn btn-success ms-1 text-white">Export</a>
            </div>
        </div>
        <div class="table-responsive px-2">
            <table id="myTable" class="table table-hover align-middle table-responsive" style="width:100%">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-white">No</th>
                        <th class="text-white">Desa</th>
                        <th class="text-white">Warna</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataDesa as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->nama_desa }}</td>
                        <td>
                            <div class="kotak-warna rounded-lg"
                                style="background-color: {{ $data->warna }}; width: 100%; height: 70px; border-radius: 10px">
                            </div>
                        </td>
                        <td class="align-middle">
                            @can('is_adminDesa', $data)
                            <div class="container-aksi align-items-center">
                                <a href="/admin/desa/{{ $data->id }}/edit" class="badge bg-warning d-block mb-1"><i
                                        class="bi bi-pencil-square me-1"></i>
                                    Edit</a>
                                <form action="/admin/desa/{{ $data->id }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0 w-100"
                                        onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i
                                            class="bi bi-trash me-1"></i>
                                        Hapus
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
                        <th class="text-white">No</th>
                        <th class="text-white">Desa</th>
                        <th class="text-white">Warna</th>
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
                {"width" : "5%"}, 
                {"width" : "60%"}, 
                null, 
                null, 
            ]  
        });
    });
</script>
@endpush