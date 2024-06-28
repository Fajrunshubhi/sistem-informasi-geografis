@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> Desa
    </h4>
    @error ('nama_desa')
    <div class="alert alert-danger alert-dismissible col-sm-8" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tambah Data Desa</h5>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="post" action="/admin/desa">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label class="form-label" for="desa">Nama Desa</label>
                                    <input type="text" id="desa"
                                        class="form-control @error('nama_desa') is-invalid @enderror" name="nama_desa"
                                        placeholder="Nama desa" required autofocus value="{{ old('nama_desa') }}" />
                                    @error ('nama_desa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="warna-desa"
                                        class="col-md-10 form-label @error('warna') is-invalid @enderror">Warna</label>
                                    <input class="form-control" type="color" id="warna-desa" name="warna" required
                                        value="{{ old('warna') }}" />
                                    @error ('warna')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="geojson">Geojson </label>
                                    <button type="button" class="badge bg-primary border-0 text-nowrap"
                                        data-bs-toggle="popover" data-bs-offset="0,14" data-bs-placement="top"
                                        data-bs-html="true" data-bs-content="<p>1. Buka website https://geojson.io </p> 
                                <p>2. Gambar wilayah menggunakan tools Rectangular Polygon </p> 
                                <p>3. Edit gambar yang dibuat, sesuaikan dengan wilayah yang dituju</p>
                                <p>4. Simpan dan copy kode geojson</p>
                                <p>5. Inputkan data geojson</p>" title="Input data GeoJSON ?">
                                        ?
                                    </button>
                                    <textarea id="geojson" class="form-control @error('geojson') is-invalid @enderror"
                                        placeholder="GeoJSON" name="geojson"> {{ old('geojson') }} </textarea>
                                    @error('geojson')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="row mb-3 mt-5">
                                    <div class="col-12 d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="/admin/desa" class="btn btn-danger">Batal</a>
                                    </div>
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