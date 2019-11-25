window.onload = changeImg;   /*implemente changeImg*/
let myTimer;
const time = 5000;
const images = ["image/image1.PNG",
              "image/image2.JPG",
              "image/image3.JPG",
              "image/image4.JPG",];
let i;
var legendes = ['Bienvenue sur VELO CLICK','Vous pouvez utiliser les fleches directionelles du clavier', 'Cliquer sur un vélos là oû vous en desirez un','Puis remplissez le formulaire pour signer'];

function changeImg() { 
    if (i < images.length - 1) 
         {i++;
            document.slide.src = images[i];
            textSlider.textContent = legendes[i];}                                                                  
    else {i = 0;
        document.slide.src = images[0];
        textSlider.textContent = legendes[i];}             
    myTimer = setTimeout("changeImg()", time);  
}

function suivant() {
    if (i < images.length - 1) 
         {i++;
            document.slide.src = images[i];
            textSlider.textContent = legendes[i];}            
    else {i = 0;
        document.slide.src = images[0];
        textSlider.textContent = legendes[i];}               
    clearTimeout(myTimer);
    myTimer = setTimeout("changeImg()", time);
    clearTimeout(myTimer);
}

function precedent() {
    if (i > 0) 
         {i = i - 1;    
            document.slide.src = images[i];
            textSlider.textContent = legendes[i];}            
    else {i = 3;
        document.slide.src = images[3];
        textSlider.textContent = legendes[i];}              
    clearTimeout(myTimer);
    myTimer = setTimeout("changeImg()", time);
    clearTimeout(myTimer);
}

pause = () => {
    clearTimeout(myTimer);
    document.getElementById('pauseButton').style.visibility='hidden';
    document.getElementById('playButton').style.visibility='visible';
}

play = () =>{
    clearTimeout(myTimer);
    myTimer = setTimeout("changeImg()", time);
    document.getElementById('playButton').style.visibility='hidden';
    document.getElementById('pauseButton').style.visibility='visible';
}

  $(document).keydown(function (e) {
    if (e.keyCode === 37){
        precedent();
    }
    else if (e.keyCode === 39){
        suivant();
    }
  });
            // On initialise la latitude et la longitude de Paris (centre de la carte)
            var lat = 48.852969;
            var lon = 2.349903;
            var macarte = null;
            // Fonction d'initialisation de la carte
            function initMap() {
                // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
                macarte = L.map('map').setView([lat, lon], 11);
                // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                    // Il est toujours bien de laisser le lien vers la source des données
                    attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
                    minZoom: 1,
                    maxZoom: 20
                }).addTo(macarte);
            }
            window.onload = function(){
		// Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
		initMap(); 
            };

 
            let objetAjax = {
                url: null,
                methode: 'GET',
                request: function(callback) {
                    if (this.url == null) {
                        console.error('L\'url n\'est pas défini')
                        return;
                    }
             
                    let request = new XMLHttpRequest();
                    request.open(this.methode, this.url);
                    request.addEventListener('error', function() {
                        console.error('Erreur réseau');
                    });
             
                    request.addEventListener('load', function () {
                        if (request.status >= 200 && request.status <= 400) {
                            if (callback)
                                    request.responseText;
                        }
                        else console.error(request.status + ' ' + request.statusText);
                    });
                    request.send(null);
                  }
            };


        
   
  //GET https://api.jcdecaux.com/vls/v1/stations?contract={contract_name}&apiKey={abd717c168a5d21c3c4874d7c3ec7626a856ff2f}
