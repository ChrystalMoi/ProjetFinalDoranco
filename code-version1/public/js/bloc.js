// Création de la carte
let mymap = L.map('mapid').setView([48.8566, 2.3522], 11);

// Ajout de la couche de tuiles OpenStreetMap
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    maxZoom: 18
}).addTo(mymap);

// Boucle pour ajouter les marqueurs à la carte
imports.forEach(function (point) {
    let name = point.name;
    let latlng = point.latlng;
    let codepostal = point.codepostal;

    L.marker(latlng).addTo(mymap)
    .bindPopup("<b>" + name + "</b><br>" + codepostal);

    console.log("Point ajouté :", name, latlng, codepostal);
});