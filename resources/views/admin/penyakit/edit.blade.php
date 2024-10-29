@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/penyakit">Data Penyakit</a>
    </h4>
    @error ('nama_penyakit')
    <div class="alert alert-danger alert-dismissible col-sm-8" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Edit Data Penyakit</h5>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="/admin/penyakit/{{ $penyakit->id }}">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <label class="form-label" for="nama-penyakit">Nama Penyakit</label>
                                    <input type="text"
                                        class="form-control @error('nama_fasilitas') is-invalid @enderror"
                                        value="{{ old('nama_penyakit', $penyakit->nama_penyakit) }}" id="nama-penyakit"
                                        name="nama_penyakit" placeholder="Nama penyakit" required autofocus />
                                    @error ('nama_penyakit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4" style="margin-top: 3px">
                                    <label class="form-label d-block" for="select-kategori-penyakit">Kategori</label>
                                    <select class="form-control select @error('kategori') is-invalid @enderror"
                                        name="kategori" required id="select-jenis-kelamin">
                                        <option value="">Pilih Kategori</option>
                                        <option value="Menular" {{ old('kategori', $penyakit->
                                            kategori)=='Menular'
                                            ? 'selected' : ''
                                            }}>Menular</option>
                                        <option value="Tidak Menular" {{ old('kategori',$penyakit->
                                            kategori)=='Tidak Menular'
                                            ? 'selected' : ''
                                            }}>Tidak Menular</option>
                                    </select>
                                    @error ('kategori')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-8">
                                    <label class="form-label" for="deskripsi">Deskripsi</label>
                                    <textarea id="deskripsi" name="deskripsi"
                                        class="form-control @error('deskripsi') is-invalid @enderror"
                                        placeholder="Deskripsi"
                                        required>{{ old('deskripsi', $penyakit->deskripsi) }}</textarea>
                                    @error ('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="warna-penyakit"
                                        class="col-md-10 form-label @error('warna') is-invalid @enderror">Warna</label>
                                    <input class="form-control" type="color" id="warna-penyakit" name="warna" required
                                        value="{{ old('warna', $penyakit->warna) }}" />
                                    @error ('warna')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="gejala">Gejala</label>
                                    @error('gejala')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input id="gejala" type="hidden" name="gejala"
                                        value="{{ old('gejala', $penyakit->gejala) }}">
                                    <trix-editor input="gejala"></trix-editor>
                                </div>
                            </div>
                            <div class=" row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="metode-pengobatan">Metode Pengobatan</label>
                                    @error('metode_pengobatan')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input id="metode-pengobatan" type="hidden" name="metode_pengobatan"
                                        value="{{ old('metode_pengobatan', $penyakit->metode_pengobatan) }}">

                                    <trix-editor input="metode-pengobatan">
                                    </trix-editor>
                                </div>
                            </div>
                            <div class=" row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="tindakan-pencegahan">Tindakan Pencegahan</label>
                                    @error('tindakan_pencegahan')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input id="tindakan-pencegahan" type="hidden" name="tindakan_pencegahan"
                                        value="{{ old('tindakan_pencegahan', $penyakit->tindakan_pencegahan) }}">

                                    <trix-editor input="tindakan-pencegahan">
                                    </trix-editor>
                                </div>
                            </div>
                            <div class="row mb-3 mt-5">
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-danger" href="/admin/penyakit">Batal</a>
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
        $('#nama-penyakit').focus();
        window.scrollTo(0, 0);
    });
</script>
@endpush