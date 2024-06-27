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
                        <form method="POST" action="/admin/berita-informasi/{{ $berita_informasi->id }}"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="judul">Judul</label>
                                    <input type="text" id="judul"
                                        class="form-control @error('judul') is-invalid @enderror"
                                        value="{{ old('judul', $berita_informasi->judul) }}" name="judul"
                                        placeholder="Judul berita dan informasi kesehatan" required />
                                    @error ('judul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="gambar" class="form-label">Gambar</label>
                                            <input type="hidden" name="oldImage"
                                                value="{{ $berita_informasi->gambar }}">
                                            <input class="form-control @error('gambar') is-invalid @enderror"
                                                type="file" name="gambar" id="gambar" onchange="previewImage()"
                                                value="{{ old('gambar', $berita_informasi->gambar) }}" />
                                            @error ('gambar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <img src="" alt="" class="img-preview img-fluid mb-3 col-sm-5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="isi">Isi Berita dan Informasi
                                        Kesehatan</label>
                                    @error('isi')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                    <input id="isi" type="hidden" name="isi"
                                        value="{{ old('isi', $berita_informasi->isi) }}">
                                    <trix-editor input="isi" placeholder="Isi berita dan informasi kesehatan">
                                    </trix-editor>
                                </div>
                            </div>
                            <div class="row mb-3 mt-5">
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-danger" href="/admin/berita-informasi">Batal</a>
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

    function previewImage() {
        const image = document.querySelector('#gambar');
        const imgPreview = document.querySelector('.img-preview')
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function (oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
@endpush