@extends('layouts.app')

@section('main-container')
<h1 class="text-center mb-3 mt-3">Berita dan Informasi Kesehatan</h1>
<div class="row justify-content-center">
    <div class="col-md-6 mb-3">
        <form action="/berita-informasi">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari berita dan informasi kesehatan..."
                    name="search-berita-informasi" value="{{ request('search-berita-informasi') }}">
                <button class="btn btn-primary z-1" type="submit">Search</button>
            </div>
        </form>
    </div>
</div>

@if ($berita_informasi->count())
@php
// Menggunakan Carbon untuk memformat tanggal
$tanggal = \Carbon\Carbon::parse($berita_informasi[0]->created_at);
$hari = $tanggal->translatedFormat('l'); // Hari dalam Bahasa Indonesia
$bulan = $tanggal->translatedFormat('F'); // Bulan dalam Bahasa Indonesia
$tanggalFormatted = $tanggal->format('d'); // Tanggal dalam format angka
$tahun = $tanggal->format('Y'); // Tahun dalam format angka
$jam = $tanggal->format('H:i'); // Jam mulai dalam format 24 jam
@endphp
<div class="card mb-3">
    <div style="max-height: 300px; overflow: hidden">
        <img src="{{ asset('storage/'.$berita_informasi[0]->gambar) }}" alt="{{ $berita_informasi[0]->judul }}"
            class="img-fluid my-2">
    </div>
    <div class="card-body text-center">
        <h3 class="card-title color-font-primary fw-bold"><a href="/berita_informasi/{{ $berita_informasi[0]->slug }}"
                class="text-decoration-none">{{
                $berita_informasi[0]->judul
                }}</a></h3>
        <p class="m-0">Dibuat oleh <span class="color-font-primary fw-bold">{{ $berita_informasi[0]->user->nama
                }}</span>
            {{ $berita_informasi[0]->created_at->diffForHumans() }}
        </p>
        <p class="m-0">{{ $berita_informasi[0]->user->role }} <span class="color-font-primary fw-bold">Desa {{
                $berita_informasi[0]->user->desa->nama_desa }}</span></p>
        <p>{{ $hari }}, {{ $tanggalFormatted }} {{ $bulan }} {{ $tahun }}, {{ $jam }} WIB</p>
        <p class="card-text">{{ $berita_informasi[0]->excerpt }}</p>
        <a href="/berita-informasi/{{ $berita_informasi[0]->slug }}" class="text-decoration-none btn btn-primary">Baca
            selengkapnya...</a>
    </div>
</div>


<div class="container deskripsi-container">
    <div class="row">
        @foreach ($berita_informasi->skip(1) as $data)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div style="max-height: 200px; overflow: hidden">
                    <img src="{{ asset('storage/'.$data->gambar) }}" alt="{{ $data->judul }}" class="img-fluid my-2">
                </div>
                <div class="card-body">
                    <h5 class="card-title color-font-primary fw-bold mb-1">{{ $data->judul }}</h5>
                    <p>{{ $hari }}, {{ $tanggalFormatted }} {{ $bulan }} {{ $tahun }}, {{ $jam }} WIB</p>
                    <p class="m-0">Dibuat oleh <span class="color-font-primary fw-bold">{{ $data->user->nama }}</span>
                        {{
                        $data->created_at->diffForHumans() }}</p>
                    <p>{{ $berita_informasi[0]->user->role }} <span class="color-font-primary fw-bold">Desa
                            {{
                            $berita_informasi[0]->user->desa->nama_desa }}</span></p>
                    <p class="card-text">{{ $data->excerpt }}</p>
                    <a href="/berita-informasi/{{ $data->slug }}" class="btn btn-primary">Baca selengkapnya... </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<p class="text-center fs-4">Berita dan Informasi Kesehatan Tidak Ditemukan!</p>
@endif
<div class="d-flex justify-content-end px-4">
    {{ $berita_informasi->links() }}
</div>


@endsection