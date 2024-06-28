@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/data/fasilitas-kesehatan">Fasilitas Kesehatan</a>
    </h4>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible col-sm-8" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tabel Data Fasilitas Kesehatan</h5>
            <div class="my-3 me-4 list-btn-data">
                <a href="/admin/data/fasilitas-kesehatan/create" class="btn btn-primary btn-tambah-data">Tambah Data</a>
                <button type="button" class="btn btn-success ms-1">Export</button>
            </div>
        </div>
        <div class="table-responsive px-2">
            <table id="myTable" class="table table-hover align-middle table-responsive" style="width:120%">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-white">Desa</th>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Kategori</th>
                        <th class="text-white">No HP</th>
                        <th class="text-white">Alamat</th>
                        <th class="text-white">Latitude</th>
                        <th class="text-white">Longitude</th>
                        <th class="text-white">Gambar</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fasilitas_kesehatan as $data)
                    <tr>
                        <td>{{ $data->desa->nama_desa }}</td>
                        <td>{{ $data->nama_fasilitas }}</td>
                        <td>{{ $data->kategori->nama }}</td>
                        <td>{{ $data->no_tlpn }}</td>
                        <td>{{ $data->alamat }}</td>
                        <td>{{ $data->latitude }}</td>
                        <td>{{ $data->longitude }}</td>
                        <td class="p-0">
                            <div class="w-75" style="max-height: 350px; overflow: hidden;">
                                <img src="{{ asset('storage/'.$data->gambar) }}" alt="{{ $data->nama_fasilitas }}"
                                    class="img-fluid my-2">
                            </div>
                        </td>
                        <td>
                            @can('is_adminDesa', $data->desa)
                            <div class="container-aksi align-items-center">
                                <a href="/admin/data/fasilitas-kesehatan/{{ $data->id }}/edit"
                                    class="badge bg-warning d-block mb-2"><i
                                        class="bi bi-pencil-square me-1"></i>Edit</a>
                                <form action="/admin/data/fasilitas-kesehatan/{{ $data->id }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0 w-100"
                                        onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i
                                            class="bi bi-trash"></i> Hapus
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
                        <th class="text-white">Desa</th>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Kategori</th>
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
                { "width": "20%" }, 
                { "width": "10%" }, 
                null, 
                { "width": "30%" },
                null,
                null,
                null,
                null,
            ]  
        });
    });
</script>
@endpush