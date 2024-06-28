@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/pasien">Data Pasien</a>
    </h4>
    @error ('desa_id')
    <div class="alert alert-danger alert-dismissible col-sm-8" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    @error ('id')
    <div class="alert alert-danger alert-dismissible col-sm-8" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror

    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tambah Data Pasien</h5>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="/admin/pasien">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="id">NIK</label>
                                    <input type="text" class="form-control @error('id') is-invalid @enderror" id="id"
                                        name="id" value="{{ old('id') }}" placeholder="NIK" required />
                                    @error ('id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="nama">Nama Pasien</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}" placeholder="Nama pasien"
                                        required />
                                    @error ('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4" style="margin-top: 3px">
                                    <label class="form-label d-block" for="select-nama-desa">Nama Desa</label>
                                    <select class="form-control select @error('desa_id') is-invalid @enderror"
                                        value="{{ old('desa_id') }}" id="select-nama-desa" name="desa_id" required>
                                        <option>Pilih Desa</option>
                                        @foreach ($desa as $data)
                                        <option value="{{ $data->id }}" {{ old('desa_id')==$data->id ? 'selected' :
                                            ''}}>{{ $data->nama_desa }}</option>
                                        @endforeach
                                    </select>
                                    @error ('desa_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label" for="no_tlpn">No Hp</label>
                                    <input type="text" name="no_tlpn" id="no_tlpn"
                                        class="form-control phone-mask @error('no_tlpn') is-invalid @enderror"
                                        value="{{ old('no_tlpn') }}" placeholder="08xxxxxxxxxx" required />
                                    @error ('no_tlpn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4" style="margin-top: 3px">
                                    <label class="form-label d-block" for="select-jenis-kelamin">Jenis Kelamin</label>
                                    <select class="form-control select @error('jenis_kelamin') is-invalid @enderror"
                                        name="jenis_kelamin" required id="select-jenis-kelamin">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki' ? 'selected' : ''
                                            }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan' ? 'selected' : ''
                                            }}>Perempuan</option>
                                    </select>
                                    @error ('jenis_kelamin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="umur" class="form-label">Umur</label>
                                    <input class="form-control @error('umur') is-invalid @enderror" min="0" max="100"
                                        type="number" value="{{ old('umur') }}" id="umur" placeholder="Umur" name="umur"
                                        required />
                                    @error ('umur')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <textarea id="alamat" name="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat"
                                        required>{{ old('alamat') }}</textarea>
                                    @error ('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 mt-5">
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-danger" href="/admin/pasien">Batal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('.select').select2({
            width: 'resolve'
        });
    });
</script>
@endpush