@extends('layouts.app')

@section('main-container')
<h1 class="text-center mb-3 mt-3">Sebaran Kondisi Kesehatan Masyarakat</h1>
<div class="row mb-3">
    <div class="col-12">
        <form action="/sebaran/kondisi-kesehatan" method="GET" id="desa-form">
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
        }).addTo({{ $data->nama_desa }});
    @endforeach

    // Membuat layer penyakit
    @foreach ($penyakit as $data)
        let penyakit{{ $data->id }} = L.layerGroup().addTo(map);
    @endforeach

    // Membuat layer kategori menular/tidak menular
    let kategoriMenular = L.layerGroup().addTo(map);
    let kategoriTidakMenular = L.layerGroup().addTo(map);
    

    // Membuat warna marker icon
    @foreach ($penyakit as $data)
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
   
    // Mengisi nilai layer group penyakit
    @foreach ($kondisi_kesehatan as $data)
        @php
        // Menggunakan Carbon untuk memformat tanggal
        $tanggal = \Carbon\Carbon::parse($data->waktu_terdeteksi);
        $hari = $tanggal->translatedFormat('l'); // Hari dalam Bahasa Indonesia
        $bulan = $tanggal->translatedFormat('F'); // Bulan dalam Bahasa Indonesia
        $tanggalFormatted = $tanggal->format('d'); // Tanggal dalam format angka
        $tahun = $tanggal->format('Y'); // Tahun dalam format angka
        $jam = $tanggal->format('H:i'); // Jam mulai dalam format 24 jam
        @endphp
        
        @if ($kondisi_kesehatan->count() == 1)
            let markerBounds = L.marker([{{ $data->latitude }}, {{ $data->longitude }}]).addTo(penyakit{{ $data->penyakit_id }});
            map.fitBounds(markerBounds.getLatLng().toBounds(100)); // Menggunakan bounds dari marker
        @endif

        let marker{{ $data->id }} = L.marker([{{ $data->latitude }}, {{ $data->longitude }}], {
            title: "Penyakit : {{ $data->penyakit->nama_penyakit }}",
            icon: customIcon{{ $data->penyakit_id }},
        })
        .bindPopup(`
            <div style="width: 400px;">
                <div class="header">
                    <h5 class="title color-font-primary fw-bold">Kondisi Kesehatan Masyarakat
                    </h5>
                </div>
                <div class="body">                 
                    <div class="row mb-2">
                        <div class="col-4"><strong>Desa</strong>:</div>
                        <div class="col-8"> {{ $data->pasien->desa->nama_desa }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4"><strong>Nama</strong>:</div>
                        <div class="col-8">-</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4"><strong>Umur</strong>:</div>
                        <div class="col-8">{{ $data->pasien->umur }} Tahun</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4"><strong>Jenis Kelamin</strong>:</div>
                        <div class="col-8">{{ $data->pasien->jenis_kelamin }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4"><strong>Waktu Terdeteksi</strong>:</div>
                        <div class="col-8"> {{ $hari }}, {{ $tanggalFormatted }} {{ $bulan }} {{ $tahun }},{{ $jam }} WIB</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4"><strong>Nama Penyakit</strong>:</div>
                        <div class="col-8">{{ $data->penyakit->nama_penyakit }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4"><strong>Kategori</strong>:</div>
                        <div class="col-8">{{ $data->penyakit->kategori }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4"><strong>Deskripsi</strong>:</div>
                        <div class="col-8">{{ $data->penyakit->deskripsi }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4"><strong>Gejala</strong>:</div>
                        <div class="col-8">{!! $data->penyakit->gejala !!}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><strong>Metode Pengobatan</strong>:</div>
                        <div class="col-8">{!! $data->penyakit->metode_pengobatan !!}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-4"><strong>Tindakan Pencegahan</strong>:</div>
                        <div class="col-8">{!! $data->penyakit->tindakan_pencegahan !!}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4"><strong>Latitude</strong>:</div>
                        <div class="col-8"> {{ $data->latitude }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-4"><strong>Longitude</strong>:</div>
                        <div class="col-8"> {{ $data->longitude }}</div>
                    </div>

                </div>
            </div>      
        `, {
            className: 'custom-popup'  // Terapkan custom class CSS
        })
        .addTo(penyakit{{ $data->penyakit_id }});
        
        // Jika kategori adalah "Menular", tambahkan juga ke kategoriMenular
        @if ($data->penyakit->kategori == "Menular")
            marker{{ $data->id }}.addTo(kategoriMenular);
        @elseif ($data->penyakit->kategori == "Tidak Menular")
            // Jika kategori adalah "Tidak Menular", tambahkan ke kategoriTidakMenular
            marker{{ $data->id }}.addTo(kategoriTidakMenular);
        @endif

    @endforeach   

    // Memasukan layer group ke overlayer sesuai dengan isinya
    let overLayer = {
        @foreach ($desa as $data)
            "Desa {{ $data->nama_desa }}" : {{ $data->nama_desa }},
        @endforeach
        "Menular" : kategoriMenular,
        "Tidak Menular" : kategoriTidakMenular,
        @foreach ($penyakit as $data)
            "<span style='background-color: {{ $data->warna }}; width: 15px; height: 15px; display: inline-block; margin-left: 3px; margin-right: 5px; border-radius: 100%;'></span> {{ $data->nama_penyakit }}" : penyakit{{ $data->id }},
        @endforeach
    }
    
    let layerControl = L.control.layers(baseMaps, overLayer).addTo(map);


</script>
@endpush