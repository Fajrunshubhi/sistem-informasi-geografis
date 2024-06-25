@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> Data Penyakit
    </h4>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible col-sm-8" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tabel Data Penyakit</h5>
            <div class="my-3 me-4 list-btn-data">
                <a href="/admin/penyakit/create" class="btn btn-primary btn-tambah-data">Tambah Data</a>
                <button type="button" class="btn btn-success ms-1">Export</button>
            </div>
        </div>
        <div class="table-responsive px-2">
            <table id="myTable" class="table table-hover align-middle table-responsive" style="width:100%">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Deskripsi</th>
                        <th class="text-white">Kategori</th>
                        <th class="text-white">Gejala</th>
                        <th class="text-white">Pengobatan</th>
                        <th class="text-white">Pencegahan</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penyakit as $data)
                    <tr>
                        <td>{{ $data->nama_penyakit }}</td>
                        <td>{{ (str_word_count($data->deskripsi) > 10 ? substr($data->deskripsi,0,75)."..."
                            : $data->deskripsi)
                            }}</td>
                        <td>{{ $data->kategori }}</td>
                        <td>{{ (str_word_count($data->gejala) > 10 ? substr($data->gejala,0,75)."..."
                            : $data->gejala)
                            }}</td>
                        <td>{{ (str_word_count($data->metode_pengobatan) > 10 ?
                            substr($data->metode_pengobatan,0,75)."..."
                            : $data->metode_pengobatan)
                            }}</td>
                        <td>{{ (str_word_count($data->tindakan_pencegahan) > 10 ?
                            substr($data->tindakan_pencegahan,0,75)."..."
                            : $data->tindakan_pencegahan)
                            }}</td>
                        <td>
                            <div class="container-aksi align-items-center">
                                <a href="/admin/penyakit/{{ $data->id }}/edit" class="badge bg-warning d-block mb-2"><i
                                        class="bi bi-pencil-square me-1"></i>Edit</a>
                                <form action="/admin/penyakit/{{ $data->id }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0 w-100"
                                        onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i
                                            class="bi bi-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot class="bg-primary">
                    <tr>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Deskripsi</th>
                        <th class="text-white">Kategori</th>
                        <th class="text-white">Gejala</th>
                        <th class="text-white">Pengobatan</th>
                        <th class="text-white">Pencegahan</th>
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
        });
    });
</script>
@endpush