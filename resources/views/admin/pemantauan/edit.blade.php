@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/pemantauan">Pemantauan Penyakit</a>
    </h4>
    @error ('kondisi_kesehatan_id')
    <div class="alert alert-danger alert-dismissible col-sm-8" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Edit Data Pemantauan Penyakit</h5>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="/admin/pemantauan/{{ $pemantauan->id }}">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6" style="margin-top: 3px">
                                    <label class="form-label d-block" for="select-idkondisi-kesehatan">ID Kondisi
                                        Kesehatan
                                        Masyarakat</label>
                                    <select
                                        class="form-control select @error('kondisi_kesehatan_id') is-invalid @enderror"
                                        id="select-idkondisi-kesehatan" value="{{ old('kondisi_kesehatan_id') }}"
                                        name="kondisi_kesehatan_id" required>
                                        <option>ID</option>
                                        @foreach ($kondisi_kesehatan as $data)
                                        <option value="{{ $data->id }}" {{ old('kondisi_kesehatan_id', $pemantauan->
                                            kondisi_kesehatan_id)==$data->id ?
                                            'selected' :
                                            ''}}>{{ $data->id }}</option>
                                        @endforeach
                                    </select>
                                    @error ('kondisi_kesehatan_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="nama-pasien" class="form-label">Nama Pasien</label>
                                    <input class="form-control" type="text" readonly required id="nama-pasien"
                                        value="{{ $pemantauan->kondisi_kesehatan->pasien->nama }} | {{ $pemantauan->kondisi_kesehatan->pasien->umur }} Tahun | {{ $pemantauan->kondisi_kesehatan->pasien->jenis_kelamin }}" />
                                </div>
                                <div class="col-md-3">
                                    <label for="nama-penyakit" class="form-label">Nama Penyakit</label>
                                    <input class="form-control" type="text" readonly required id="nama-penyakit"
                                        value="{{ $pemantauan->kondisi_kesehatan->penyakit->nama_penyakit }}" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6" style="margin-top: 3px">
                                    <label class="form-label d-block" for="select-tingkat-keparahan">Tingkat
                                        Keparahan</label>
                                    <select class="form-control select @error('tingkat_keparahan') is-invalid @enderror"
                                        value="{{ old('tingkat_keparahan') }}" name="tingkat_keparahan" required
                                        id="select-tingkat-keparahan">
                                        <option>Tingkat Keparahan</option>
                                        <option value="Ringan (Mild)" {{ old('tingkat_keparahan', $pemantauan->
                                            tingkat_keparahan)=='Ringan (Mild)' ? 'selected' : '' }}>
                                            Ringan (Mild)
                                        </option>
                                        <option value="Sedang (Moderate)" {{ old('tingkat_keparahan', $pemantauan->
                                            tingkat_keparahan)=='Sedang (Moderate)' ? 'selected' : '' }}>Sedang
                                            (Moderate)
                                        </option>
                                        <option value="Berat (Severe)" {{ old('tingkat_keparahan', $pemantauan->
                                            tingkat_keparahan)=='Berat (Severe)' ? 'selected' : '' }}>Berat (Severe)
                                        </option>
                                        <option value="Kritis (Critical)" {{ old('tingkat_keparahan', $pemantauan->
                                            tingkat_keparahan)=='Kritis (Critical)' ? 'selected' : '' }}>Kritis
                                            (Critical)</option>
                                    </select>
                                    @error ('tingkat_keparahan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block" for="waktu-pemantauan"> Waktu Pemantauan </label>
                                    <input class="form-control @error('waktu_pemantauan') is-invalid @enderror"
                                        name="waktu_pemantauan" type="datetime-local"
                                        value="{{ old('waktu_pemantauan', $pemantauan->waktu_pemantauan) }}"
                                        id="waktu-pemantauan" required />
                                    @error ('waktu_pemantauan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="keterangan">Keterangan</label>
                                    <textarea id="keterangan" name="keterangan"
                                        class="form-control @error('keterangan') is-invalid @enderror"
                                        placeholder="Keterangan"
                                        required>{{ old('keterangan', $pemantauan->keterangan) }}</textarea>
                                    @error ('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 mt-5">
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-danger" href="/admin/pemantauan">Batal</a>
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

    $(document).ready(function() {
        $('#select-idkondisi-kesehatan').change(function() {
            let selectedValue = $(this).val();
            let namaPasien = '';
            let namaPenyakit = '';
            @foreach ($kondisi_kesehatan as $data)
                if ({{ $data->id }} == selectedValue) {
                    namaPasien = "{{ $data->pasien->nama }} | {{ $data->pasien->umur }} Tahun | {{ $data->pasien->jenis_kelamin }}";
                    namaPenyakit = "{{ $data->penyakit->nama_penyakit }}"
                }
            @endforeach 
            $('#nama-pasien').val(namaPasien);
            $('#nama-penyakit').val(namaPenyakit);
        });
    });
</script>
@endpush