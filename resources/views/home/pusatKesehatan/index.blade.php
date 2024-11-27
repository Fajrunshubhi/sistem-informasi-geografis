@extends('layouts.app')

@section('main-container')
<h1 class="text-center mb-3 mt-3">Sebaran Pusat Kesehatan</h1>
<div class="row mb-3">
    <div class="col-12">
        <form action="/sebaran/pusat-kesehatan" method="GET" id="desa-form">
            <select class="form-control select" value="{{ request()->get('nama_desa') }}" id="select-nama-desa"
                name="nama_desa" required onchange="this.form.submit()">
                <option value="">Semua Desa</option>
                @foreach ($desa_all as $data)
                <option value="{{ $data->nama_desa }}" {{ request()->get('nama_desa')==$data->nama_desa ? 'selected' :
                    '' }}>{{
                    $data->nama_desa }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>
<div class="container container-map d-flex justify-content-center z-0">
    <div id="map" style="width: 100%; height: 500px;"></div>
</div>

@endsection
@push('js')
<script>
    $(document).ready(function() {
        $('.select').select2({
            width: 'resolve'
        });
    });

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
    let marker = L.marker([-7.824893908172728, 109.96604338891359]).addTo(map);

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

    // Membuat layer group dari masing-masing desa
    @foreach ($desa as $data)
        let {{ $data->nama_desa }} = L.layerGroup().addTo(map);
    @endforeach

    // List map
    let baseMaps = {
        "OpenStreetMap": osm,
        "OpenStreetMap.HOT": osmHOT,
        "MapTilerStreet": mapTilerStreet,
        "MapTilerSatelit": mapTilerSatelit,
    };

    // Mengisi nilai layer group
    @foreach ($desa as $data)
        @if ($desa->count() == 1)
            map.fitBounds(L.geoJSON({!! $data->geojson !!}, {
            style: {
                color: '{{ $data->warna }}',
                fillOpacity: 0.1
            }
        }).addTo({{ $data->nama_desa }}).getBounds())
        @endif

        L.geoJSON({!! $data->geojson !!}, {
            style: {
                color: '{{ $data->warna }}',
                fillOpacity: 0.1
            }
        }).bindPopup("Desa {{ $data->nama_desa }}").addTo({{ $data->nama_desa }});
    @endforeach

    // Simpan marker pusat kesehatan dalam objek
    let pusatKesehatanMarkers = {};
    // Membuat layer pusat kesehatan
    let pusatKesehatan = L.layerGroup().addTo(map);
    // Memasukan layer group ke overlayer sesuai dengan isinya
    let overLayerPusatKesehatan = {
        "Pusat Kesehatan" : pusatKesehatan
    };

    // Membuat warna marker icon
    @foreach ($desa as $data)
        // Membuat warna marker icon
        let warna{{ $data->id }} = "{{ $data->warna }}";
        // Membuat ikon dengan menggunakan warna dari PHP
        let customIcon{{ $data->id }} = L.divIcon({
            className: 'custom-marker', 
            html: `<div style="color: ${warna{{ $data->id }}}; font-size: 24px;">
                     <i class="bi fs-1 bi-geo-alt-fill"></i>
               </div>`,
            iconSize: [20, 20], 
            iconAnchor: [10, 20] 
        });
    @endforeach
   
    // Mengisi nilai layer group pusat kesehatan
    @foreach ($pusat_kesehatan as $data)
        @if ($pusat_kesehatan->count() == 1)
            let markerBounds = L.marker([{{ $data->latitude }}, {{ $data->longitude }}]).addTo(pusatKesehatan);
            map.fitBounds(markerBounds.getLatLng().toBounds(100)); // Menggunakan bounds dari marker
        @endif

        let marker{{ $data->id }} = L.marker([{{ $data->latitude }}, {{ $data->longitude }}], {
            title: "{{ $data->nama_pusat_kesehatan }}",
            icon: customIcon{{ $data->desa_id }},
            alt: "Gambar {{ $data->gambar }}"
            
        })
            .bindPopup(`
                <div style="width: 400px;">
                    <div class="header">
                        <h5 class="title color-font-primary fw-bold">Pusat Kesehatan
                        </h5>
                    </div>
                    <div class="body">                 
                        <div class="row mb-2">
                            <div class="col-6"><strong>Desa</strong>:</div>
                            <div class="col-6"> {{ $data->desa->nama_desa }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-6"><strong>Nama Pusat Kesehatan</strong>:</div>
                            <div class="col-6"> {{ $data->nama_pusat_kesehatan }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-6"><strong>No HP</strong>:</div>
                            <div class="col-6"> {{ $data->no_tlpn }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-6"><strong>Alamat</strong>:</div>
                            <div class="col-6">{{ $data->alamat }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-6"><strong>Latitude</strong>:</div>
                            <div class="col-6"> {{ $data->latitude }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-6"><strong>Longitude</strong>:</div>
                            <div class="col-6"> {{ $data->longitude }}</div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="w-100 d-flex justify-content-center">
                                    <img src="{{ asset('storage/'.$data->gambar) }}"
                                        alt="{{ $data->nama_pusat_kesehatan }}"
                                        class="img-fluid w-50">
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>      
            `, {
                className: 'custom-popup'  // Terapkan custom class CSS
            })
            .addTo(pusatKesehatan);
            // Simpan marker dalam objek berdasarkan desa
            if (!pusatKesehatanMarkers[{{ $data->desa_id }}]) {
                pusatKesehatanMarkers[{{ $data->desa_id }}] = [];
            }
            pusatKesehatanMarkers[{{ $data->desa_id }}].push(marker{{ $data->id }});
    @endforeach   

    // Fungsi untuk mengatur visibilitas marker pusat kesehatan
    function updatePusatKesehatanVisibility() {
        @foreach ($desa as $data)
            if (map.hasLayer({{ $data->nama_desa }})) {
                pusatKesehatanMarkers[{{ $data->id }}].forEach(marker => marker.addTo(pusatKesehatan));
            } else {
                pusatKesehatanMarkers[{{ $data->id }}].forEach(marker => pusatKesehatan.removeLayer(marker));
            }
        @endforeach
    }
    
    @foreach ($desa as $data)
        {{ $data->nama_desa }}.on('add', updatePusatKesehatanVisibility);
        {{ $data->nama_desa }}.on('remove', updatePusatKesehatanVisibility);
    @endforeach
    
    // HEAT MAP 
    let heatMapDataPerDesa = {};
    @foreach ($desa as $data)
        // Inisialisasi heatmapData untuk desa
        heatMapDataPerDesa[{{ $data->id }}] = [];
    @endforeach

    @foreach ($pusat_kesehatan as $data)
        heatMapDataPerDesa[{{ $data->desa_id }}].push([{{ $data->latitude }}, {{ $data->longitude }}, 2]);
    @endforeach

    // Objek untuk menyimpan layer heatmap per desa
    let heatmapLayers = {};

    // Membangun heatmap layer per desa
    @foreach ($desa as $data)
        let heatLayer{{ $data->id }} = L.heatLayer(heatMapDataPerDesa[{{ $data->id }}], {
            radius: 25,
            blur: 15,
            maxZoom: 17,
            gradient: {
                0.4: 'blue',
                0.65: 'lime',
                1: '{{ $data->warna }}' // Sesuaikan dengan warna desa
            }
        });
        // Simpan heatmap layer dalam objek untuk desa ini
        heatmapLayers[{{ $data->id }}] = heatLayer{{ $data->id }};
    @endforeach

    // Fungsi untuk mengupdate visibilitas heatmap berdasarkan desa
    function updateHeatmapVisibility() {
        @foreach ($desa as $data)
            if (map.hasLayer({{ $data->nama_desa }})) {
                // Jika layer desa aktif, tambahkan heatmap untuk desa ini
                heatmapLayers[{{ $data->id }}].addTo(map);
            } else {
                // Jika layer desa tidak aktif, hapus heatmap untuk desa ini
                heatmapLayers[{{ $data->id }}].remove();
            }
        @endforeach
    }

    // Menambahkan event untuk menambahkan dan menghapus heatmap berdasarkan layer desa
    @foreach ($desa as $data)
        {{ $data->nama_desa }}.on('add', updateHeatmapVisibility);
        {{ $data->nama_desa }}.on('remove', updateHeatmapVisibility);
    @endforeach


    // Membuat tombol kontrol heatmap
    let HeatmapControl = L.Control.extend({
        options: {
            position: 'topleft' // Posisi kontrol di kiri atas
        },

        onAdd: function(map) {
            let button = L.DomUtil.create('button', 'leaflet-control-heatmap');
            button.innerHTML = 'HeatMap'; // Menampilkan teks atau ikon pada tombol
            button.title = "Toggle Heatmap"; // Tooltip saat hover
            button.style = 'border-radius:8px; border: none; background-color: white; padding: 8px; cursor: pointer;';

            // Ketika tombol diklik, jalankan fungsi toggleHeatmap
            L.DomEvent.on(button, 'click', this._toggleHeatmap.bind(this));

            return button;
        },

        _toggleHeatmap: function() {
            let isHeatmapVisible = false;
            // Cek apakah ada heatmap layer yang aktif
            @foreach ($desa as $data)
                if (map.hasLayer(heatmapLayers[{{ $data->id }}])) {
                    isHeatmapVisible = true;
                }
            @endforeach
            // Logika toggle heatmap dan marker
            if (isHeatmapVisible) {
                // Jika heatmap sudah aktif, hapus semua heatmap dan tampilkan marker
                @foreach ($desa as $data)
                    map.removeLayer(heatmapLayers[{{ $data->id }}]); // Hapus heatmap untuk desa ini
                @endforeach

                // Tampilkan kembali semua marker
                @foreach ($desa as $data)
                    pusatKesehatanMarkers[{{ $data->id }}].forEach(marker => marker.addTo(pusatKesehatan)); // Tampilkan marker desa ini
                @endforeach
            } else {
                // Jika heatmap belum aktif, tampilkan heatmap untuk desa yang aktif
                @foreach ($desa as $data)
                    map.addLayer(heatmapLayers[{{ $data->id }}]); // Tampilkan heatmap untuk desa ini
                @endforeach

                // Sembunyikan marker saat heatmap aktif
                @foreach ($desa as $data)
                    pusatKesehatanMarkers[{{ $data->id }}].forEach(marker => pusatKesehatan.removeLayer(marker)); // Sembunyikan marker desa ini
                @endforeach
            }
        }
    });

    // Menambahkan kontrol heatmap ke peta
    map.addControl(new HeatmapControl());


    let overLayer = {
        @foreach ($desa as $data)
            "Desa {{ $data->nama_desa }}" : {{ $data->nama_desa }},
        @endforeach
        // "Tampilkan HeatMap" : heatLayer
    }
    // Menambahkan heatmap layers ke objek overlay
    @foreach ($desa as $data)
        overLayer["Heatmap " + "{{ $data->nama_desa }}"] = heatmapLayers[{{ $data->id }}];
    @endforeach


    L.Routing.control({
    waypoints: [
        L.latLng(57.77687684, 11.97987984),
        L.latLng(89.12313, 11.9493131)
    ]
    }).addTo(map);
    L.latLng(-7.828557854922326, 109.9393682517317),
            L.latLng(7.836618426574526, 109.94533447712078)
    
    let layerControl = L.control.layers(baseMaps, overLayer).addTo(map);

    layerControl.addOverlay(pusatKesehatan, "Pusat Kesehatan");

</script>
@endpush