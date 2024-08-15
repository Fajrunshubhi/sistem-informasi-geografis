@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/profil-kecamatan">Profil Kecamatan</a>
    </h4>
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Edit Data Profil Kecamatan</h5>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="/admin/profil-kecamatan/{{ $profil_kecamatan->id }}">
                            @csrf
                            @method('put')
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="nama-kecamatan">Nama Kecamatan</label>
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror" id="nama-kecamatan"
                                        value="{{ old('nama', $profil_kecamatan->nama) }}" placeholder="Nama Kecamatan"
                                        required />
                                    @error ('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="no_tlpn">No Hp</label>
                                    <input type="text" name="no_tlpn" id="no_tlpn"
                                        class="form-control phone-mask @error('no_tlpn') is-invalid @enderror"
                                        value="{{ old('no_tlpn', $profil_kecamatan->no_tlpn) }}"
                                        placeholder="08xxxxxxxxxx" required />
                                    @error ('no_tlpn')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $profil_kecamatan->email) }}" id="email" name="email"
                                        placeholder="Email" required />
                                    @error ('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <textarea id="alamat" name="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat"
                                        required>{{ old('alamat', $profil_kecamatan->alamat) }}</textarea>
                                    @error ('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="deskripsi">Deskripsi</label>
                                    @error('deskripsi')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input id="deskripsi" type="hidden" name="deskripsi"
                                        value="{{ old('deskripsi', $profil_kecamatan->deskripsi) }}">
                                    <trix-editor input="deskripsi" placeholder="Deskripsi">
                                    </trix-editor>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <div id="map" style="height: 300px"></div>
                                </div>
                                <div class="col-md-4">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input class="form-control @error('latitude') is-invalid @enderror" type="text"
                                        value="{{ old('latitude', $profil_kecamatan->latitude) }}" readonly required
                                        id="latitude" name="latitude" />
                                    @error ('latitude')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input class="form-control @error('longitude') is-invalid @enderror" type="text"
                                        readonly required id="longitude" name="longitude"
                                        value="{{ old('longitude', $profil_kecamatan->longitude) }}" />
                                    @error ('longitude')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3 mt-5">
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-danger" href="/admin/profil-kecamatan">Batal</a>
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


    let osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });
    let osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
    });

    const key = 'KkGDVJv1GsVinRe0vQUy';
    let mapTilerSatelit = L.tileLayer(`https://api.maptiler.com/maps/satellite/?key=${key}`,{
        tileSize: 512,
        zoomOffset: -1,
        minZoom: 1,
        attribution: "\u003ca href=\"https://www.maptiler.com/copyright/\" target=\"_blank\"\u003e\u0026copy; MapTiler\u003c/a\u003e \u003ca href=\"https://www.openstreetmap.org/copyright\" target=\"_blank\"\u003e\u0026copy; OpenStreetMap contributors\u003c/a\u003e",
        crossOrigin: true
    });
    // https://api.maptiler.com/maps/streets-v2/style.json?key=KkGDVJv1GsVinRe0vQUy
    // https://api.maptiler.com/maps/streets-v2/tiles.json?key=KkGDVJv1GsVinRe0vQUy
    let mapTilerStreet = L.tileLayer(`https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=${key}`,{
        tileSize: 512,
        zoomOffset: -1,
        minZoom: 1,
        attribution: "\u003ca href=\"https://www.maptiler.com/copyright/\" target=\"_blank\"\u003e\u0026copy; MapTiler\u003c/a\u003e \u003ca href=\"https://www.openstreetmap.org/copyright\" target=\"_blank\"\u003e\u0026copy; OpenStreetMap contributors\u003c/a\u003e",
        crossOrigin: true
    });
    

    let desa = L.layerGroup();

    let map = L.map('map', {
        center: [document.getElementById('latitude').value, document.getElementById('longitude').value],
        zoom: 15,
        layers: [osm]
    });
    
    let marker = L.marker([document.getElementById('latitude').value, document.getElementById('longitude').value], {
        draggable: true,
        clickable: true
    }).addTo(map);

    L.control.locate({
        locateOptions: {
            maxZoom: 19,
            enableHighAccuracy: true
        },
        strings: {
            title: "Anda di sini!"
        }
        })
        .addTo(map);

    marker.on('dragend', function (e) {
        let position = marker.getLatLng();
        document.getElementById('latitude').value = position.lat;
        document.getElementById('longitude').value = position.lng;
    })
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        console.log(e.latlng);
        document.getElementById('latitude').value = e.latlng.lat;
        document.getElementById('longitude').value = e.latlng.lng;
    });
        let overLayer = {
            "desa" : desa
        };
        let baseMaps = {
            "OpenStreetMap": osm,
            "OpenStreetMap.HOT": osmHOT,
            "MapTilerSatelit": mapTilerSatelit,
            "MapTilerStreet": mapTilerStreet
        };
        L.control.layers(baseMaps, overLayer).addTo(map);

</script>
@endpush