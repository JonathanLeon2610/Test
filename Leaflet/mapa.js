let map = L.map('map').setView([24.136296,-110.3181249680159],13)

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

document.getElementById('select-location').addEventListener('change', function(e){
    let coords = e.target.value.split(",");
    map.flyTo(coords,13);
})

// Agregar mapa base
var carto_light = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {attribution: '©OpenStreetMap, ©CartoDB',subdomains: 'abcd',maxZoom: 24});

// Agregar plugin MiniMap
var minimap = new L.Control.MiniMap(carto_light,
    {
        toggleDisplay: true,
        minimized: false,
        position: "bottomleft"
    }).addTo(map);

// Agregar escala
 new L.control.scale({imperial: false}).addTo(map);

// Configurar PopUp
function popup(feature,layer){
    if(feature.properties && feature.properties.Name){
        layer.bindPopup("<strong>Barrio: </strong>" + feature.properties.Name + "<br/>" + "<strong>Direccion: </strong>" + feature.properties.descript_1);
    }
}

// Agregar capa en formato GeoJson
L.geoJson(puntos).addTo(map);

var barriosJS = L.geoJson(puntos,{
    onEachFeature: popup
}).addTo(map);