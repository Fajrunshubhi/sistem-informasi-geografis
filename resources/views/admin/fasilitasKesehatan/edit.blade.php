@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> <a href="/admin/data/fasilitas-kesehatan">Fasilitas Kesehatan</a>
    </h4>
    @error ('desa_id')
    <div class="alert alert-danger alert-dismissible col-sm-8" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @enderror
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Edit Fasilitas Kesehatan</h5>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="/admin/data/fasilitas-kesehatan/{{ $fasilitas_kesehatan->id }}"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label d-block" for="select-nama-desa">Nama Desa</label>
                                    <select class="form-control select @error('desa_id') is-invalid @enderror"
                                        value="{{ old('desa_id') }}" id="select-nama-desa" name="desa_id" required>
                                        <option>Pilih Desa</option>
                                        @foreach ($desa as $data)
                                        <option value="{{ $data->id }}" {{ old('desa_id', $fasilitas_kesehatan->desa_id
                                            )==$data->id ? 'selected' :
                                            ''}}>{{ $data->nama_desa }}</option>
                                        @endforeach
                                    </select>
                                    @error ('desa_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="nama-fasilitas-kesehatan">Nama Fasilitas
                                        Kesehatan</label>
                                    <input type="text"
                                        class="form-control @error('nama_fasilitas') is-invalid @enderror"
                                        id="nama-fasilitas-kesehatan"
                                        value="{{ old('nama_fasilitas', $fasilitas_kesehatan->nama_fasilitas) }}"
                                        name="nama_fasilitas" placeholder="Fasilitas Kesehatan" required />
                                    @error ('nama_fasilitas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block" for="select-kategori-fasilitas">Kategori
                                        Fasilitas</label>
                                    <select class="form-control select @error('kategori_id') is-invalid @enderror"
                                        value="{{ old('kategori_id') }}" name="kategori_id" required
                                        id="select-kategori-fasilitas">
                                        <option>Pilih Kategori Fasilitas Kesehatan</option>
                                        @foreach ($kategori as $data)
                                        <option value="{{ $data->id }}" {{ old('kategori_id', $fasilitas_kesehatan->
                                            kategori_id ) == $data->id ? 'selected' :
                                            ''}}>{{ $data->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error ('kategori_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="no_tlpn">No Hp</label>
                                    <input type="text" name="no_tlpn" id="no-hp"
                                        class="form-control phone-mask @error('no_tlpn') is-invalid @enderror"
                                        value="{{ old('no_tlpn', $fasilitas_kesehatan->no_tlpn) }}"
                                        placeholder="08xxxxxxxxxx" required />
                                    @error ('no_tlpn')
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
                                                value="{{ $fasilitas_kesehatan->gambar }}">
                                            <input class="form-control @error('gambar') is-invalid @enderror"
                                                type="file" name="gambar" id="gambar" onchange="previewImage()"
                                                value="{{ old('gambar', $fasilitas_kesehatan->gambar) }}" />
                                            @error ('gambar')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            @if ($fasilitas_kesehatan->gambar)
                                            <img src="{{ asset('storage/'.$fasilitas_kesehatan->gambar) }}" alt=""
                                                class="img-preview img-fluid mb-3 col-sm-5">
                                            @else
                                            <img src="" alt="" class="img-preview img-fluid mb-3 col-sm-5">
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <img src="" alt="" class="img-preview img-fluid mb-3 col-sm-5">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <textarea id="alamat" name="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat"
                                        required>{{ old('alamat', $fasilitas_kesehatan->alamat) }}</textarea>
                                    @error ('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input class="form-control @error('latitude') is-invalid @enderror" type="text"
                                        value="{{ old('latitude', $fasilitas_kesehatan->latitude) }}" readonly required
                                        id="latitude" name="latitude" />
                                    @error ('latitude')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input class="form-control @error('longitude') is-invalid @enderror" type="text"
                                        value="{{ old('longitude', $fasilitas_kesehatan->longitude) }}" readonly
                                        required id="longitude" name="longitude" />
                                    @error ('longitude')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div id="map" style="height: 300px"></div>
                                </div>
                            </div>
                            <div class="row mb-3 mt-5">
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a class="btn btn-danger" href="/admin/data/fasilitas-kesehatan">Batal</a>
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


    // Buat map
    let map = L.map('map', {
        center: [-7.824893908172728, 109.96604338891359],
        zoom: 15,
    });
    // Map 1
    let osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    // Map 2
    let osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
    });

    const key = 'KkGDVJv1GsVinRe0vQUy';
    // Map 3
    let mapTilerStreet = L.tileLayer(`https://api.maptiler.com/maps/streets-v2/{z}/{x}/{y}.png?key=${key}`,{
        tileSize: 512,
        zoomOffset: -1,
        minZoom: 1,
        attribution: "\u003ca href=\"https://www.maptiler.com/copyright/\" target=\"_blank\"\u003e\u0026copy; MapTiler\u003c/a\u003e \u003ca href=\"https://www.openstreetmap.org/copyright\" target=\"_blank\"\u003e\u0026copy; OpenStreetMap contributors\u003c/a\u003e",
        crossOrigin: true
    });
    // Map 4 (err)
    let mapTilerSatelit = L.tileLayer(`https://api.maptiler.com/tiles/satellite-v2/{z}/{x}/{y}.png?key=${key}`,{ //style URL
        tileSize: 512,
        zoomOffset: -1,
        minZoom: 1,
        attribution: "\u003ca href=\"https://www.maptiler.com/copyright/\" target=\"_blank\"\u003e\u0026copy; MapTiler\u003c/a\u003e \u003ca href=\"https://www.openstreetmap.org/copyright\" target=\"_blank\"\u003e\u0026copy; OpenStreetMap contributors\u003c/a\u003e",
        crossOrigin: true
      });
    
    // Marker untuk ambil nilai latitude longitude
    let marker = L.marker([-7.824893908172728, 109.96604338891359], {
        draggable: true,
        clickable: true
    }).addTo(map);

    // Lokasi sekarang 
    L.control.locate({
        locateOptions: {
            maxZoom: 19,
            enableHighAccuracy: true
        },
        strings: {
            title: "Anda di sini!"
        }
    }).addTo(map);

    // Mengambil nilai latitude longitude
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

    // List map
    let baseMaps = {
        "OpenStreetMap": osm,
        "OpenStreetMap.HOT": osmHOT,
        "MapTilerStreet": mapTilerStreet,
        "MapTilerSatelit": mapTilerSatelit,
    };

    L.control.layers(baseMaps).addTo(map);

</script>
@endpush