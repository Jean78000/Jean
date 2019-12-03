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


var canvasDiv = document.getElementById('canvasDiv');
canvas = document.createElement('canvas');
canvas.setAttribute('width', 500);
canvas.setAttribute('height', 300);
canvas.setAttribute('id', 'canvas');
canvasDiv.appendChild(canvas);
if(typeof G_vmlCanvasManager != 'undefined') {
	canvas = G_vmlCanvasManager.initElement(canvas);
}
context = canvas.getContext("2d");

$('#canvas').mousedown(function(e){
    var mouseX = e.pageX - this.offsetLeft;
    var mouseY = e.pageY - this.offsetTop;
          
    paint = true;
    addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);
    redraw();
  });

  $('#canvas').mousemove(function(e){
    if(paint){
      addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
      redraw();
    }
  });

  $('#canvas').mouseup(function(e){
    paint = false;
  });

  $('#canvas').mouseleave(function(e){
    paint = false;
  });

  var clickX = new Array();
var clickY = new Array();
var clickDrag = new Array();
var paint;

function addClick(x, y, dragging)
{
  clickX.push(x);
  clickY.push(y);
  clickDrag.push(dragging);
}

function redraw(){
    context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas
    
    context.strokeStyle = "#df4b26";
    context.lineJoin = "round";
    context.lineWidth = 5;
              
    for(var i=0; i < clickX.length; i++) {		
      context.beginPath();
      if(clickDrag[i] && i){
        context.moveTo(clickX[i-1], clickY[i-1]);
       }else{
         context.moveTo(clickX[i]-1, clickY[i]);
       }
       context.lineTo(clickX[i], clickY[i]);
       context.closePath();
       context.stroke();
    }
  }

  canvas = () => {
    document.getElementById('canvasDiv').style.visibility='visible';
}
