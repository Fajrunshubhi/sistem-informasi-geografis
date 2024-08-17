@extends('layouts.app')

@section('main-container')
<div class="container mt-3">
    <h3 class="color-font-primary d-inline-block mb-3 border-bottom border-primary border-3">Pusat Kesehatan</h3>
    <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 g-4">
        @foreach ($kontak_pusat_kesehatan as $data)
        <div class="col">
            <div class="card">
                <img src="{{ asset('storage/'.$data->gambar) }}" class="card-img-top" height="200px"
                    alt="Gambar {{ $data->nama_pusat_kesehatan }}">
                <div class="card-body">
                    <h5 class="card-title color-font-primary">{{ $data->nama_pusat_kesehatan }}</h5>
                    <p class="card-text">{{ $data->alamat }}</p>
                    <p class="card-text"><i class="bi bi-telephone-plus-fill me-2"></i>{{ $data->no_tlpn }}</p>
                    <p class="card-text color-font-primary">Desa {{ $data->desa->nama_desa }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <h3 class="color-font-primary d-inline-block mb-3 border-bottom border-primary border-3 mt-4">Fasilitas Kesehatan
    </h3>
    <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 g-4">
        @foreach ($kontak_fasilitas_kesehatan as $data)
        <div class="col">
            <div class="card">
                <img src="{{ asset('storage/'.$data->gambar) }}" class="card-img-top" height="200px"
                    alt="Gambar {{ $data->nama_fasilitas }}">
                <div class="card-body">
                    <h5 class="card-title color-font-primary">{{ $data->nama_fasilitas }}</h5>
                    <p class="card-text color-font-primary">{{ $data->kategori->nama }}</p>
                    <p class="card-text">{{ $data->alamat }}</p>
                    <p class="card-text"><i class="bi bi-telephone-plus-fill me-2"></i>{{ $data->no_tlpn }}</p>
                    <p class="card-text color-font-primary">Desa {{ $data->desa->nama_desa }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <h3 class="color-font-primary d-inline-block mb-3 border-bottom border-primary border-3 mt-4">Layanan Kesehatan
    </h3>
    <div class="row row-cols-1 row-cols-lg-4 row-cols-md-2 g-4">
        @foreach ($kontak_layanan_kesehatan as $data)
        @php
        // Menggunakan Carbon untuk memformat tanggal
        $tanggal = \Carbon\Carbon::parse($data->waktu_layanan);
        $hari = $tanggal->translatedFormat('l'); // Hari dalam Bahasa Indonesia
        $bulan = $tanggal->translatedFormat('F'); // Bulan dalam Bahasa Indonesia
        $tanggalFormatted = $tanggal->format('d'); // Tanggal dalam format angka
        $tahun = $tanggal->format('Y'); // Tahun dalam format angka
        $jam = $tanggal->format('H:i'); // Jam mulai dalam format 24 jam
        @endphp
        <div class="col">
            <div class="card">
                <img src="{{ asset('storage/'.$data->gambar) }}" class="card-img-top" height="200px"
                    alt="Gambar {{ $data->nama_layanan }}">
                <div class="card-body">
                    <h5 class="card-title color-font-primary">{{ $data->nama_layanan }}</h5>
                    <p class="card-text">{{ $hari }}, {{ $tanggalFormatted }} {{ $bulan }} {{ $tahun }} <br> {{
                        $jam }} s/d
                        selesai</p>
                    <p class="card-text">{{ $data->alamat }}</p>
                    <p class="card-text"><i class="bi bi-telephone-plus-fill me-2"></i>{{ $data->no_tlpn }}</p>
                    <p class="card-text color-font-primary">Desa {{ $data->desa->nama_desa }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection