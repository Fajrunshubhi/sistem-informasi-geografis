@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> Kategori Fasilitas
    </h4>
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Edit Kategori Fasilitas</h5>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="post" action="/admin/data/kategori-fasilitas/{{ $kategoriFasilitas->id }}">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label class="form-label" for="nama-kategori-fasilitas">Nama Kategori Fasilitas
                                    </label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama-kategori-fasilitas" placeholder="Nama" autofocus
                                        value="{{ $kategoriFasilitas->nama }}" name="nama" />
                                    @error ('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="warna-kategori-fasilitas"
                                        class="col-md-10 form-label @error('warna') is-invalid @enderror">Warna</label>
                                    <input class="form-control" type="color" id="warna-kategori-fasilitas" name="warna"
                                        required value="{{ old('warna', $kategoriFasilitas->warna) }}" />
                                    @error ('warna')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 mt-5">
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="/admin/data/kategori-fasilitas" class="btn btn-danger">Batal</a>
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