@extends('layouts.app')
@section('main-container')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                    <div class="app-brand justify-content-center h2 mb-3">
                        <a href="#" class="app-brand-link gap-2">
                            <span class="app-brand-text text-body fw-bolder">Kecamatan @if ($profil_kecamatan->nama)
                                {{ $profil_kecamatan->nama }}
                                @else
                                -
                                @endif</span>
                        </a>
                    </div>
                    <hr>
                    <h4 class="mb-4 lh-base text-center">Sistem Informasi Geografis <br> Sebaran Kesehatan
                    </h4>
                    <p class="mb-2">Silahkan masuk ke akun anda!</p>

                    <form id="formAuthentication" class="mb-3" action="login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" id="email" name="email" placeholder="Email" required />
                            @error ('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror"
                                value="{{ old('password') }}" id="password" name="password" placeholder="password"
                                required />
                            @error ('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3 mt-5">
                            <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection