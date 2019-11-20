window.onload = changeImg;   /*implemente le JS au chargement de la fenetre*/
let myTimer;
let i = 0;
const time = 5000;
const images = ["image/image1.PNG",
              "image/image2.JPG",
              "image/image3.JPG",
              "image/image4.JPG",];
            
function changeImg() {              
    document.slide.src = images[i];  /*la source est l'indice 0 : 1ére image*/
    if (i < images.length - 1) 
         {i++;}                     /* fait passé à l'indice 1 : 2 eme image*/
    else {i = 0;}                   /* une fois que i > au nombre d'images on repart à 0 */
    console.log(i);
    myTimer = setTimeout("changeImg()", time);  /*fonction qui permet de repeter changeImg toute les 5 secondes*/
}

function suivant() {
    document.slide.src = images[i];  
    if (i < images.length - 1) 
         {i++;}                     
    else {i = 0;}                   
    clearTimeout(myTimer);
    myTimer = setTimeout("changeImg()", time);
    console.log(i);
}

function precedent() {
    document.slide.src = images[i]; 
    if (i > 0) 
         {i = i - 1;}  
    else {i = 3;}
    console.log(i);
    clearTimeout(myTimer);
    myTimer = setTimeout("changeImg()", time);
}

pause = () => {
    clearTimeout(myTimer);
  }

play = () =>{
    clearTimeout(myTimer);
    myTimer = setTimeout("changeImg()", time);
  }

  $(document).keydown(function (e) {
    if (e.keyCode === 37){
        precedent();
    }
    else if (e.keyCode === 39){
        suivant();
    }
  });
