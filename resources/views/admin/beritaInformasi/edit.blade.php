@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> Berita dan Informasi Kesehatan
    </h4>
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Edit Data Berita dan Informasi Kesehatan</h5>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label class="form-label" for="judul">Judul</label>
                                    <input type="text" id="judul" class="form-control" placeholder="Judul" />
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="gambar-berita">Gambar</label>
                                    <input type="file" id="gambar-berita" class="form-control" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="isi-berita-informasi">Isi Berita dan Informasi
                                        Kesehatan</label>
                                    <input id="isi-berita-informasi" type="hidden" name="isi-berita-informasi">
                                    <trix-editor input="isi-berita-informasi"
                                        placeholder="Isi berita dan informasi kesehatan">
                                    </trix-editor>
                                </div>
                            </div>
                            <div class="row mb-3 mt-5">
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="submit" class="btn btn-danger">Batal</button>
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