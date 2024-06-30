@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/berita-informasi">Berita dan Informasi Kesehatan</a>
    </h4>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible col-sm-8" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tabel Data Berita dan Informasi Kesehatan</h5>
            <div class="my-3 me-4 list-btn-data">
                <a href="/admin/berita-informasi/create" class="btn btn-primary btn-tambah-data">Tambah Data</a>
                <a href="{{ route('berita.informasi.export') }}" class="btn btn-success ms-1 text-white">Export</a>
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
                    @foreach ($berita_informasi as $data)
                    <tr>
                        <td>{{ $data->user->nama }}</td>
                        <td>{{ $data->user->role }}</td>
                        <td>{{ $data->judul }}</td>
                        <td>{{ (str_word_count($data->isi) > 10 ? substr($data->isi,0,75)."..."
                            : $data->isi)
                            }}</td>
                        <td class="p-0">
                            <div class="w-75" style="max-height: 350px; overflow: hidden;">
                                <img src="{{ asset('storage/'.$data->gambar) }}" alt="{{ $data->judul }}"
                                    class="img-fluid my-2">
                            </div>
                        </td>
                        <td>
                            @can('is_adminDesa', $data->user->desa)
                            <div class="container-aksi align-items-center">
                                <a href="/admin/berita-informasi/{{ $data->id }}/edit"
                                    class="badge bg-warning d-block mb-2"><i
                                        class="bi bi-pencil-square me-1"></i>Edit</a>
                                <form action="/admin/berita-informasi/{{ $data->id }}" method="POST">
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
                { "width": "15%" }, 
                { "width": "15%" }, 
                { "width": "20%" }, 
                { "width": "25%" }, 
                null, 
                null,
            ]  
        });
    });
</script>
@endpush