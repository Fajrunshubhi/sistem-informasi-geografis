@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> Kondisi Kesehatan Masyarakat
    </h4>
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Tambah Data Kondisi Kesehatan Masyarakat</h5>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="/admin/data/kondisi-kesehatan">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-6" style="margin-top: 3px">
                                    <label class="form-label d-block" for="select-idpasien">Id Pasien</label>
                                    <select class="form-control select @error('pasien_id') is-invalid @enderror"
                                        value="{{ old('pasien_id') }}" id="select-idpasien" name="pasien_id" required>
                                        <option>Pilih ID Pasien</option>
                                        @foreach ($pasien as $data)
                                        <option value="{{ $data->id }}" {{ old('pasien_id')==$data->id ? 'selected' :
                                            ''}}>{{ $data->id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="nama-pasien" class="form-label">Nama Pasien</label>
                                    <input class="form-control" type="text" readonly required id="nama-pasien" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6" style="margin-top: 3px">
                                    <label class="form-label d-block" for="select-nama-penyakit">Nama Penyakit</label>
                                    <select class="form-control select @error('penyakit_id') is-invalid @enderror"
                                        value="{{ old('penyakit_id') }}" name="penyakit_id" required
                                        id="select-nama-penyakit">
                                        <option>Pilih Nama Penyakit</option>
                                        @foreach ($penyakit as $data)
                                        <option value="{{ $data->id }}" {{ old('penyakit_id')==$data->id ? 'selected' :
                                            ''}}>{{ $data->nama_penyakit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label d-block" for="waktu_terdeteksi"> Waktu Layanan </label>
                                    <input class="form-control @error('waktu_terdeteksi') is-invalid @enderror"
                                        type="datetime-local" value="{{ old('waktu_terdeteksi') }}"
                                        id="waktu_terdeteksi" name="waktu_terdeteksi" required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input class="form-control @error('latitude') is-invalid @enderror" type="text"
                                        value="{{ old('latitude') }}" readonly required id="latitude" name="latitude" />
                                    @error ('latitude')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input class="form-control @error('longitude') is-invalid @enderror" type="text"
                                        value="{{ old('longitude') }}" readonly required id="longitude"
                                        name="longitude" />
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
                                    <a class="btn btn-danger" href="/admin/data/kondisi-kesehatan">Batal</a>
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
        $('#nama-pasien').val('');
        $('#select-idpasien').change(function() {
            let selectedValue = $(this).val();
            let namaPasien = '';
            // let umur = '';
            // let jenis_kelamin = '';
            @foreach ($pasien as $data)
                if ({{ $data->id }} == selectedValue) {
                    namaPasien = "{{ $data->nama }} | {{ $data->umur }} Tahun | {{ $data->jenis_kelamin }}   ----->   Desa {{ $data->desa->nama_desa }}";
                }
            @endforeach 
            $('#nama-pasien').val(namaPasien);
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
        center: [-7.824893908172728, 109.96604338891359],
        zoom: 15,
        layers: [osm]
    });
    
    let marker = L.marker([-7.824893908172728, 109.96604338891359], {
        draggable: true,
        clickable: true
    }).addTo(map);

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