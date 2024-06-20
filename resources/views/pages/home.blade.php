@extends('components.layout.index')
@section('content')
    @component('components.section.title')
        Home
    @endcomponent
    
    {{-- Maps --}}
    <div id="peta"></div>

    <script>
        // Provide Map in Webpage
        const providerOSM = new GeoSearch.OpenStreetMapProvider();
    
        // leaflet map
        var leafletMap = L.map('peta', {
    
        // Map's first displayed (On Indonesian's map) 
        fullscreenControl: {
            // fullscreenControl: true  /*fullscreen to page width and height*/
            pseudoFullscreen: false 
        },
        minZoom: 4
        }).setView([0,-598], 2);
    
        L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors,  <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
            accessToken: 'your.mapbox.access.token'
        }).addTo(leafletMap);
    
        let theMarker = {};
    
        leafletMap.on('click', function(e) {
            let latitude  = e.latlng.lat.toString().substring(0,15);
            let longitude = e.latlng.lng.toString().substring(0,15);
            // document.getElementById("latitude").value = latitude;
            // document.getElementById("longitude").value = longitude;
            let popup = L.popup()
                .setLatLng([latitude,longitude])
                .setContent("Koordinat : " + latitude +" ; "+  longitude )
                .openOn(leafletMap);
    
            if (theMarker != undefined) {
                leafletMap.removeLayer(theMarker);
            };
            theMarker = L.marker([latitude,longitude]).addTo(leafletMap);  
        });
    
        const search = new GeoSearch.GeoSearchControl({
            provider: providerOSM,
            style: 'icon',
            searchLabel: 'Nama Lokasi / Koordinat',
        });
    
        leafletMap.addControl(search);
        </script>

@endsection