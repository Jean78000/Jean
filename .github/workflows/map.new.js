// initialisation de l'objet map
let MapCycle = {

// initialisation de l'objet MapCycle
init: function(lat, long, zoom) {
    this.lat = lat;
    this.long = long;
    this.zoom = zoom;
    this.displayMap();
    this.displayMarkerOnMap();
    },

// Appel à l'API jcdecaux
getApi: function() {

/*let apiKey = new XMLHttpRequest();*/
let urlApi = "https://api.jcdecaux.com/vls/v1/stations?contract=Lyon&apiKey=6aee93e5cbf1cb5f8731b09eb837afa9adb6a9f0";
/*  apiKey.open("GET", urlApi);
apiKey.addEventListener("load", function (data) {
if (apiKey.status >= 200 && apiKey.status < 400) { // Le serveur a réussi à traiter la requête
//console.log(apiKey.responseText);
 } else {
// Affichage des informations sur l'échec du traitement de la requête
     alert(apiKey.status + " " + apiKey.statusText);
    }
});
apiKey.addEventListener("error", function () {
// La requête n'a pas réussi à atteindre le serveur
alert ("Erreur réseau");
    });
apiKey.send(null);*/

return urlApi;
},

//Afficher la carte
displayMap: function() {
    map = L.map('mapID')
    .setView([this.lat, this.long], this.zoom);
// Afficher l'image de la carte
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a>contributors'
        })
    .addTo(map);
},

// ajoute les données du marqueur dans le formulaire
dataMarkerToForm: function(getStationAddress, getStandsAvailable, getBikesAvailable) {
    $('#adresse').val(getStationAddress);
    $('#placeDispo').val(getStandsAvailable);
    $('#veloDispo').val(getBikesAvailable);
},

// Affiche les marqueurs
displayMarkerOnMap: function() {
let cycleCoord = [];
$.get("https://api.jcdecaux.com/vls/v1/stations?contract=Lyon&apiKey=6aee93e5cbf1cb5f8731b09eb837afa9adb6a9f0", function(data) {
for (let i = 0; i < data.length; i++) {
    let getStationName = data[i].name;
    let getStationAddress = data[i].address;
    let getBikesAvailable = data[i].available_bikes;
    let getStandsAvailable = data[i].available_bike_stands;
    let getStationStatus = data[i].status;
    let IconMap = L.Icon.extend({
                options: {
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
                }
                });
// popup des marqueurs
let customPopup = "Nom : " + getStationName +
                "<br>Adresse : " + getStationAddress +
                "<br>Status de la station : " + getStationStatus;

// Ajoute les marqueurs sur la carte
cycleCoord.push([data[i].position.lat, data[i].position.lng]);

// Station ouverte et vélos disponibles
if (getBikesAvailable >= 0) {
    let greenIcon = new IconMap({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png'
        });
    L.marker(cycleCoord[i], { icon: greenIcon }).bindPopup(customPopup)
        .on('click', function() {
            MapCycle.dataMarkerToForm(getStationAddress, getStandsAvailable, getBikesAvailable);
            SessionStorage.hideCanvas();
            })
        .addTo(map);
    }

// Stations n'ayant plus de vélos disponibles
if (getBikesAvailable === 0) {
    let redIcon = new IconMap({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png'
        });
    L.marker(cycleCoord[i], { icon: redIcon }).bindPopup(customPopup)
        .on('click', function() {
            MapCycle.dataMarkerToForm(getStationAddress, getStandsAvailable, getBikesAvailable);
            SessionStorage.hideCanvas();
            })
        .addTo(map);
                }

// Stations fermées
if (data[i].status !== 'OPEN') {
    let blackIcon = new IconMap({
                        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-black.png',
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png'
                    });
    L.marker(cycleCoord[i], { icon: blackIcon }).bindPopup(customPopup)
                        .on('click', function() {
                            MapCycle.dataMarkerToForm(getStationAddress, getStandsAvailable, getBikesAvailable);
                            SessionStorage.hideCanvas();
                        })
                        .addTo(map);
                }
            }
        });
    }
};

MapCycle.init(45.75, 4.85, 10);

// création du canvas
var canv3 = document.getElementById('cvs47');
var context3 = canv3.getContext('2d');
function gereclick(event) { 
   var XYrect = canv3.getBoundingClientRect();    // action avec le canvas et pas le context
   var Xcurseur = Math.round(event.clientX - XYrect.left); 
   var Ycurseur = Math.round(event.clientY - XYrect.top);
   context3.fillStyle= 'rgb('+Math.floor(Math.random()*255); // = rgb (r)
   context3.beginPath();
   context3.arc(Xcurseur, Ycurseur, 1.5,0, 360);
   context3.fill();
   }; 