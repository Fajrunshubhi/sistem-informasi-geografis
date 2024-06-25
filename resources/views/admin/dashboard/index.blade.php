@extends('admin.layouts.main')

@section('main-container')
<div class="container-xxl flex-grow-1 container-p-y">
    <h1 class="fw-bold py-3 mb-4">Dashboard</h1>
    <div id="map" style="height: 300px"></div>
    <p id="latitude"></p>
    <p id="longitude"></p>
</div>
<script>
    let osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });
    let osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
    });

    let map = L.map('map', {
        center: [-7.835591886336971, 109.94439947454818],
        zoom: 15,
        layers: [osm]
    });
    
    let marker = L.marker([-7.835591886336971, 109.94439947454818], {
        draggable: true,
        clickable: true
    }).addTo(map);

    marker.on('dragend', function (e) {
        let position = marker.getLatLng();
        document.getElementById('latitude').innerText = position.lat;
        document.getElementById('longitude').innerText = position.lng;
    })
    map.on('click', function(e) {
        marker.setLatLng(e.latlng);
        console.log(e.latlng);
        document.getElementById('latitude').innerText = e.latlng.lat;
        document.getElementById('longitude').innerText = e.latlng.lng;
    });
    
    // let overLayer = {
    //     "desa" : desa
    // };
    let baseMaps = {
        "OpenStreetMap": osm,
        "OpenStreetMap.HOT": osmHOT
    };  
    L.control.layers(baseMaps).addTo(map);

  
     // Data dari PHP ke JavaScript
     var desas = @json($desa); // Konversi data desa ke JSON



// Tambahkan GeoJSON ke peta
desas.forEach(function(desa) {
    // Pastikan setiap desa memiliki geojson dan warna
    if (desa.geojson && desa.warna) {
        L.geoJSON(JSON.parse(desa.geojson), {
            style: {
                color: 'white',
                fillColor: desa.warna
            }
        }).addTo(map);
    }
});

</script>
@endsection