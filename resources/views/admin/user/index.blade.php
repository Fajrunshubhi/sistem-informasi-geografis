@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/user">Data Users</a>
    </h4>
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible col-sm-8" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tabel Data Users</h5>
            <div class="my-3 me-4 list-btn-data">
                <a href="/admin/user/create" class="btn btn-primary btn-tambah-data">Tambah Data</a>
                <a href="{{ route('users.export') }}" class="btn btn-success ms-1 text-white">Export</a>
            </div>
        </div>
        <div class="table-responsive px-2">
            <table id="myTable" class="table table-hover align-middle table-responsive" style="width:100%">
                <thead class="bg-primary">
                    <tr>
                        <th class="text-white"></th>
                        <th class="text-white">No</th>
                        <th class="text-white">Desa</th>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Email</th>
                        <th class="text-white">Role</th>
                        <th class="text-white">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $data)

                    <tr>
                        <td>
                            <!-- View Icon with data-toggle and data-target attributes to trigger the modal -->
                            <a href="#" class="text-primary" data-bs-toggle="modal"
                                data-bs-target="#viewModal{{ $data->id }}">
                                <i class="bi bi-eye-fill fs-4"></i>
                            </a>
                        </td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $data->desa->nama_desa }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->role }}</td>
                        <td>
                            @can('is_adminDesa', $data->desa)
                            <div class="container-aksi align-items-center">
                                <form action="{{ route('user.destroy.bysuperadmin', ['user' => $data->id]) }}"
                                    method="POST">
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

                    <!-- Modal -->
                    <div class="modal fade" id="viewModal{{ $data->id }}" tabindex="-1"
                        aria-labelledby="viewModalLabel{{ $data->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="viewModalLabel{{ $data->id }}">Detail Pengguna</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Desa</strong></div>
                                            <div class="col-6">: {{ $data->desa->nama_desa }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Nama</strong></div>
                                            <div class="col-6">: {{ $data->nama }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Email</strong></div>
                                            <div class="col-6">: {{ $data->email }}</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-6"><strong>Role</strong></div>
                                            <div class="col-6">: {{ $data->role }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    @endforeach
                </tbody>
                <tfoot class="bg-primary">
                    <tr>
                        <th class="text-white"></th>
                        <th class="text-white">No</th>
                        <th class="text-white">Desa</th>
                        <th class="text-white">Nama</th>
                        <th class="text-white">Email</th>
                        <th class="text-white">Role</th>
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
                { "width": "5%" }, 
                null, 
                null, 
                null, 
                null,
                null,
            ]  
        });
    });
</script>
@endpush