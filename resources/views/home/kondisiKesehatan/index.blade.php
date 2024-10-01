@extends('layouts.app')

@section('main-container')
<h1>Kondisi Kesehatan</h1>
<div id="map" style="height: 300px"></div>


<script>
    // OPSI MAP 1
    let osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });
    // OPSI MAP 2
    let osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap contributors, Tiles style by Humanitarian OpenStreetMap Team hosted by OpenStreetMap France'
    });
    // OPSI MAP 3
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
    let mapTilerStreet = L.tileLayer(`https://api.maptiler.com/tiles/satellite-v2/?key=KkGDVJv1GsVinRe0vQUy#22.0/-7.68641/108.82941`,{
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
@endsection