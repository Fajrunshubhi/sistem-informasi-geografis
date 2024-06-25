@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><a href="/admin/dashboard" class="text-muted fw-light">SIG | Pemetaan Sebaran
            Kesehatan /</a> Data Profil Kecamatan
    </h4>
    <div class="card">
        <div class="d-flex justify-content-between">
            <h5 class="card-header d-inline">Edit Data Profil Kecamatan</h5>
        </div>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="nama-kecamatan">Nama Kecamatan</label>
                                    <input type="text" class="form-control" id="nama-kecamatan"
                                        placeholder="Nama kecamatan" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="no-hp">No Hp</label>
                                    <input type="text" id="no-hp" class="form-control phone-mask"
                                        placeholder="08xxxxxxxxxx" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <textarea id="alamat" class="form-control" placeholder="Alamat"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label" for="deskripsi">Deskripsi</label>
                                    <input id="deskripsi" type="hidden" name="deskripsi">
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
                                    <input class="form-control" type="text" readonly required id="latitude" />
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input class="form-control" type="text" readonly required id="longitude" />
                                </div>
                            </div>

                            <div class="row mb-3 mt-5">
                                <div class="col-12 d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="submit" class="btn btn-danger">Batal</button>
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