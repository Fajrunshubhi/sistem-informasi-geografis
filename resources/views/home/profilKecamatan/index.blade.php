@extends('layouts.app')

@section('main-container')
<div class="container mt-3 mb-4">
    <div class="row">
        <div class="col-lg-6">
            <iframe style="border: 0; width:100%; height: 350px;"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1175.1359023344144!2d109.96343064362523!3d-7.8246806303563625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7ae7e594c53a93%3A0x4eedeabc1f7f0457!2sKantor%20Kecamatan%20Ngombol!5e0!3m2!1sid!2sid!4v1723828780559!5m2!1sid!2sid"
                width="200" height="150" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col-lg-6">
            <h2 class="nama-kecamatan text-center lh-base fw-bolder">
                Kecamatan
                @if ($profil_kecamatan->nama)
                {{ $profil_kecamatan->nama }}
                @else
                -
                @endif
            </h2>
            <div class="info">
                <div class="alamat row">
                    <div class="col-1 me-3">
                        <div class="color-bg-primary d-inline-block px-2 py-1" style="border-radius: 50%">
                            <i class="bi bi-geo-alt-fill text-white fs-3"></i>
                        </div>
                    </div>
                    <div class="col">
                        <h4 class="color-font-primary">Alamat:</h4>
                        <p>
                            {{ $profil_kecamatan->alamat }}
                        </p>
                    </div>
                </div>
                <div class="phone mt-2">
                    <a href="tel:+081328772265" target="_blank" rel="noreferrer" class="color-font-primary-1">
                        <div class="row">
                            <div class="col-1 me-3">
                                <div class="color-bg-primary d-inline-block px-2 py-1" style="border-radius: 50%">
                                    <i class="bi bi-telephone-plus-fill text-white fs-3"></i>
                                </div>
                            </div>
                            <div class="col">
                                <h4 class="color-font-primary">Nomor HP:</h4>
                                <p>{{ $profil_kecamatan->no_tlpn }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="email mt-2">
                    <a href="mailto:{{ $profil_kecamatan->email }}" class="color-font-primary-1">
                        <div class="row">
                            <div class="col-1 me-3">
                                <div class=" color-bg-primary d-inline-block px-2 py-1" style="border-radius: 50%">
                                    <i class="bi bi-envelope-fill text-white fs-3"></i>
                                </div>
                            </div>
                            <div class="col">
                                <h4 class="color-font-primary">Email:</h4>
                                <p>{{ $profil_kecamatan->email }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="d-flex">
                    <div class="latitude me-4">
                        <p class="color-font-primary">Latitude: <span class="color-font-primary-1">{{
                                $profil_kecamatan->latitude }}</span>
                        </p>
                    </div>
                    <div class="logitude">
                        <p class="color-font-primary">Longitude: <span class="color-font-primary-1">{{
                                $profil_kecamatan->longitude }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4 ">
        <div class="container deskripsi-container">
            {!! $profil_kecamatan->deskripsi !!}
        </div>
    </div>
</div>
@endsection