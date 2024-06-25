@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> Laporan Kesehatan
    </h4>
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Edit Laporan Kesehatan</h5>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="/admin/laporan-kesehatan/{{ $laporan_kesehatan->id }}"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label d-block" for="select-nama-desa">Nama Desa</label>
                                    <select class="form-control select @error('desa_id') is-invalid @enderror"
                                        value="{{ old('desa_id') }}" id="select-nama-desa" name="desa_id" required>
                                        <option>Pilih Desa</option>
                                        @foreach ($desa as $data)
                                        <option value="{{ $data->id }}" {{ old('desa_id', $laporan_kesehatan->desa_id
                                            )==$data->id ? 'selected' :
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
                                <div class="col-md-8">
                                    <label class="form-label" for="judul-laporan">Judul</label>
                                    <input type="text" id="judul-laporan"
                                        class="form-control @error('judul_laporan') is-invalid @enderror"
                                        value="{{ old('judul_laporan', $laporan_kesehatan->judul_laporan) }}"
                                        name="judul_laporan" placeholder="Judul" required />
                                    @error ('judul_laporan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="file">File</label>
                                    <input type="hidden" name="oldFile" value="{{ $laporan_kesehatan->file }}">
                                    <input type="file" id="file"
                                        class="form-control @error('file') is-invalid @enderror" placeholder="File"
                                        name="file" value="{{ old('file', $laporan_kesehatan->file) }}" />
                                    @error ('file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="deskripsi">Deskripsi Laporan
                                        Kesehatan</label>
                                    @if ($errors->has('deskripsi'))
                                    <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                                    @endif
                                    <input id="deskripsi" type="hidden" name="deskripsi"
                                        value="{{ old('deskripsi', $laporan_kesehatan->deskripsi) }}">
                                    <trix-editor input="deskripsi" placeholder="deskripsi laporan kesehatan">
                                    </trix-editor>
                                </div>
                            </div>
                            <div class="row mb-3 mt-5">
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-danger" href="/admin/laporan-kesehatan">Batal</a>
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