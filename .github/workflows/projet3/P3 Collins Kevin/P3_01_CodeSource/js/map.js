class Map  {

    // initialisation de l'objet Map
    constructor(lat, long, zoom) {
        this.lat = lat;
        this.long = long;
        this.zoom = zoom;
        this.afficheMap();
        this.afficheMarqueur();
    }

    // Appel à l'API jcdecaux
    getApi() {
        let urlApi = "https://api.jcdecaux.com/vls/v1/stations?contract=Bruxelles&apiKey=abd717c168a5d21c3c4874d7c3ec7626a856ff2f";
        return urlApi;
    }

    // Afficher la carte
    afficheMap() {
        this.map = L.map('mapID')
            .setView([this.lat, this.long], this.zoom);
        // Afficher l'image de la carte (calque de la carte)
        L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {                    
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a>contributors'
        })
            .addTo(this.map);
    }

    // ajoute les données du marqueur dans le formulaire
    dataMarkerToForm(getStationAddress, getStandsAvailable, getBikesAvailable) {
        $('#adresse').val(getStationAddress);
        $('#placeDispo').val(getStandsAvailable);
        $('#veloDispo').val(getBikesAvailable);
    }

    // Affiche les marqueurs
    afficheMarqueur() {
        let cycleCoord = [];
        $.get("https://api.jcdecaux.com/vls/v1/stations?contract=Bruxelles&apiKey=abd717c168a5d21c3c4874d7c3ec7626a856ff2f",  (data) => {
            for (let i = 0; i < data.length; i++) {                 // parcours le json
                let getStationName = data[i].name;                     // data : variable qui contient les données du fichier que l'on parcourt avec .lenght
                let getStationAddress = data[i].address;                // on parcourt les .noeuds du json
                let getBikesAvailable = data[i].available_bikes;            
                let getStandsAvailable = data[i].available_bike_stands;         // à cette station
                let getStationStatus = data[i].status;

                let IconMap = L.Icon.extend({
                    options: {
                        iconSize: [25, 41],
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
                cycleCoord.push([data[i].position.lat, data[i].position.lng]);   // ajoute les infos dans le tableau cycleCoord

                // Station ouverte et vélos disponibles
                if (getBikesAvailable >= 0) {
                    let greenIcon = new IconMap({
                        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png'
                    });
                    L.marker(cycleCoord[i], { icon: greenIcon }).bindPopup(customPopup)
                        .on('click', function () {         
                            map.dataMarkerToForm(getStationAddress, getStandsAvailable, getBikesAvailable);
                        })
                        .addTo(this.map);
                }

                // Stations n'ayant plus de vélos disponibles
                if (getBikesAvailable === 0) {
                    let redIcon = new IconMap({
                        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png'
                    });
                    L.marker(cycleCoord[i], { icon: redIcon }).bindPopup(customPopup)
                        .on('click', function () {
                            map.dataMarkerToForm(getStationAddress, getStandsAvailable, getBikesAvailable);
                        })
                        .addTo(this.map);
                }

                // Stations fermées
                if (data[i].status !== 'OPEN') {
                    let blackIcon = new IconMap({
                        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-black.png',
                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png'
                    });
                    L.marker(cycleCoord[i], { icon: blackIcon }).bindPopup(customPopup)
                        .on('click', function () {
                            map.dataMarkerToForm(getStationAddress, getStandsAvailable, getBikesAvailable);
                        })
                        .addTo(this.map);
                }
            }
        });
    }
};

let map = new Map(50.85, 4.35, 14);
