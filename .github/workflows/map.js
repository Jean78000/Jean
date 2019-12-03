// initialisation de l'objet map
let MapCycle = {

// initialisation de l'objet MapCycle
init(lat, long, zoom) {
    this.lat = lat;
    this.long = long;
    this.zoom = zoom;
    this.afficheMap();
    this.afficheMarqueur();
    },

// Appel à l'API jcdecaux
getApi() {
/*let apiKey = new XMLHttpRequest();*/
let urlApi = "https://api.jcdecaux.com/vls/v1/stations?contract=Lyon&apiKey=abd717c168a5d21c3c4874d7c3ec7626a856ff2f";
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
afficheMap() {
    map = L.map('mapID')
    .setView([this.lat, this.long], this.zoom);
// Afficher l'image de la carte
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a>contributors'
        })
    .addTo(map);
},

// ajoute les données du marqueur dans le formulaire
dataMarkerToForm(getStationAddress, getStandsAvailable, getBikesAvailable) {
    $('#adresse').val(getStationAddress);
    $('#placeDispo').val(getStandsAvailable);
    $('#veloDispo').val(getBikesAvailable);
},

// Affiche les marqueurs
afficheMarqueur: function() {
let cycleCoord = [];
$.get("https://api.jcdecaux.com/vls/v1/stations?contract=Lyon&apiKey=abd717c168a5d21c3c4874d7c3ec7626a856ff2f", function(data) {
for (let i = 0; i < data.length; i++) {                 // parcours le json
    let getStationName = data[i].name;
    let getStationAddress = data[i].address;
    let getBikesAvailable = data[i].available_bikes;
    let getStandsAvailable = data[i].available_bike_stands;
    let getStationStatus = data[i].status;
    let IconMap = L.Icon.extend({options: { iconSize: [25, 41],
                                            iconAnchor: [12, 41],
                                            popupAnchor: [1, -34],
                                            shadowSize: [41, 41]
                                            }
                                });
// infos des marqueurs (popup)
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
canvas.setAttribute('width', 357);
canvas.setAttribute('height', 200);
canvas.setAttribute('id', 'canvas');
canvasDiv.appendChild(canvas);
if(typeof G_vmlCanvasManager != 'undefined') {             // verifie que la classe est chargée         
	canvas = G_vmlCanvasManager.initElement(canvas);        // init canvas
}
context = canvas.getContext("2d");                          //context SVG

$('#canvas').mousedown(function(e){                         // intercepteur de l'evenement
    var mouseX = e.pageX - this.offsetLeft;
    var mouseY = e.pageY - this.offsetTop;
          
    paint = true;                                              // le stylo est posé sur la feuille
    addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);  // ajoute un point sur la feuille à la position de la souris
    redraw();                                                   // redessine
  });

$('#canvas').mousemove(function(e){                           // intercepteur sur l'evenement de deplacement de la souris
    if(paint){                                                  // si le stylo est posé sur la feuille
      addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true); // ajoute un point sur la feuille à la position de la souris
      redraw();                                                 // redessine
    }
  });

$('#canvas').mouseup(function(e){                 // intercepteur sur le bouton qui est relaché
    paint = false;                                  // le stylo n'est plus sur la feuille
  });

$('#canvas').mouseleave(function(e){              // quand le curseur de la souris sort du canvas ça declenche mouseleave
    paint = false;
  });

var clickX = new Array();                           // tableau qui contient tout les points
var clickY = new Array();
var clickDrag = new Array();
var paint;

function addClick(x, y, dragging)               
{
  clickX.push(x);
  clickY.push(y);
  clickDrag.push(dragging);
}

function redraw(){                      // redessine le parcours des points
    context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas
    
    context.strokeStyle = "#df4b26";                // couleur de remplissage de la ligne
    context.lineJoin = "round";                     // style de jointure entre les lignes
    context.lineWidth = 5;                          // epaisseur de la ligne
              
    for(var i=0; i < clickX.length; i++) {		    // on parcourt tout les points
      context.beginPath();
      if(clickDrag[i] && i){                        // est ce que c'est le 1er point de la ligne
        context.moveTo(clickX[i-1], clickY[i-1]);   // on positione le curseur au point precedent
       }else{
         context.moveTo(clickX[i]-1, clickY[i]);    // on positionne le curseur au point en cours
       }
       context.lineTo(clickX[i], clickY[i]);        // on dessine une ligne jusqu'au point en cours
       context.closePath();                         // on ferme la ligne
       context.stroke();                            // on redessine
    }
  }


booking = () => {
    document.getElementById('canvasDiv').style.visibility='visible';
    document.getElementById('bouttonSigner').style.visibility='visible';
    document.getElementById('arrow').style.visibility='visible';
}


signer = () => {

let prenom = $('#name').val();
let nom = $('#surname').val();
let adress = $('#adresse').val();
let placeDispo = $('#placeDispo').val();
let veloDispo = $('#veloDispo').val();

localStorage.setItem('name', prenom);
localStorage.setItem('surname', nom);
sessionStorage.setItem('adresse', adress);
sessionStorage.setItem('placeDispo', placeDispo);
sessionStorage.setItem('veloDispo', veloDispo);

$('#surnameStorage').val(prenom);
$('#nameStorage').val(nom);
$('#adressStorage').val(adress);

context.clearRect(0, 0, 357, 200);  //nettoie le canvas
clickX.length = 0;
clickY.length = 0;
clickDrag.length = 0;  //drag: tableau qui retiens si la souris était appuyé d'un point à l'autre pour savoir si il faut faire un trait ou laisser un espace.
    
if (veloDispo == 0) {
        document.getElementById("bookingfull").innerHTML = "Il n'y a plus de vélo dispo" ;
        }
}

    
storage= () => {

let ls = localStorage.getItem('surname');
    document.getElementById('surnameStorage').value = ls;
let ls1 = localStorage.getItem('name');
    document.getElementById('nameStorage').value = ls1;
let ls2 = sessionStorage.getItem('adresse');
    document.getElementById('adressStorage').value = ls2;
let ls3 = sessionStorage.getItem('placeDispo');
    document.getElementById('placeDispo').value = ls3;
let ls4 = sessionStorage.getItem('veloDispo');
    document.getElementById('veloDispo').value = ls4;
}
            
storage();



timer= () => {

let min = 0;
let sec = 10;
    
setInterval(function(){
    document.getElementById("timer").innerHTML = "Il ne vous reste plus que "+min +" minutes "+" et " + sec +" secondes" ;
    sec--;
    if(sec == 0){min--;
                sec = 60;
                }
    else if (min == 0 && sec == 0) {
                clearInterval();
                document.getElementById("timer").innerHTML = "Votre session est expirée";
                storage.removeItem(adresse);
                storage.removeItem(placeDispo);
                storage.removeItem(veloDispo);    
                }},1000);
}
    
timer();



