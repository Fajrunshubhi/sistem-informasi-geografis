@extends('layouts.app')

@section('main-container')
@php
// Menggunakan Carbon untuk memformat tanggal
$tanggal = \Carbon\Carbon::parse($berita_informasi->created_at);
$hari = $tanggal->translatedFormat('l'); // Hari dalam Bahasa Indonesia
$bulan = $tanggal->translatedFormat('F'); // Bulan dalam Bahasa Indonesia
$tanggalFormatted = $tanggal->format('d'); // Tanggal dalam format angka
$tahun = $tanggal->format('Y'); // Tahun dalam format angka
$jam = $tanggal->format('H:i'); // Jam mulai dalam format 24 jam
@endphp
<div class="container mt-4 ">
    <div class="row justify-content-center">
        <div class="col-md-10 bg-white rounded py-4 px-4">
            <h3 class="color-font-primary fw-bold mb-0">{{ $berita_informasi->judul }}</h3>
            <hr class="mb-1">
            <p class="mt-0">{{ $hari }}, {{ $tanggalFormatted }} {{ $bulan }} {{ $tahun }}, {{ $jam }} WIB</p>
            <p class="m-0">Dibuat oleh <span class="color-font-primary fw-bold">{{ $berita_informasi->user->nama
                    }}</span>
                {{
                $berita_informasi->created_at->diffForHumans() }}</p>
            <p>{{ $berita_informasi->user->role }} <span class="color-font-primary fw-bold">Desa
                    {{
                    $berita_informasi->user->desa->nama_desa }}</span></p>
            <div class="d-flex justify-content-center">
                <img src="{{ asset('storage/'.$berita_informasi->gambar) }}" alt="{{ $berita_informasi->judul }}"
                    class="img-fluid my-2 rounded mt-3"
                    style="max-width: 100%; height: auto; max-height: 700px; object-fit: contain;">
            </div>
            <article class="my-3 fs-5 deskripsi-container">
                {!! $berita_informasi->isi !!}
            </article>
            <a class="btn btn-primary" href="/berita-informasi"><i class="bi bi-arrow-left-circle me-2 fs-5"></i> Berita
                dan
                Informasi Kesehatan</a>
        </div>
    </div>
</div>
@endsection