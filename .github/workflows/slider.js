window.onload = changeImg;   /*implemente le JS au chargement de la fenetre*/
let myTimer;
let i = 0;
const time = 5000;
const images = ["image/image1.PNG",
              "image/image2.JPG",
              "image/image3.JPG",
              "image/image4.JPG",];

var legendes = ['INDICE 0 i = 0', 'INDICE 1 i = 1','INDICE 2 i = 2', 'INDICE  i = 3'];

function changeImg() {              
    document.slide.src = images[i];  /*la source est l'indice 0 : 1ére image*/
    textSlider.textContent = legendes[i];
    console.log(i +"  "+ "fonction changeImg debut ");
    if (i < images.length - 1) 
         {i++;}                     /* fait passé à l'indice 1 : 2 eme image*/
    else {i = 0;}                   /* une fois que i > au nombre d'images on repart à 0 */
    console.log(i +"  "+ "fonction changeImg fin ");
    myTimer = setTimeout("changeImg()", time);  /*fonction qui permet de repeter changeImg toute les 5 secondes*/
}

function suivant() {
    console.log(i+"  "+ "fonction suivant debut fonction ");
    document.slide.src = images[i];
    textSlider.textContent = legendes[i];
    console.log(i+"  "+ "fonction suivant debut condition ");
    if (i < images.length - 1) 
         {i++;}           
    else {i = 0;}              
    console.log(i+"  "+ "fonction suivant fin condition ");     
    clearTimeout(myTimer);
    myTimer = setTimeout("changeImg()", time);
    console.log(i+"  "+ "fonction suivant fin");
}

function precedent() {
    console.log(i+"  "+ "fonction precedent debut fonction ");
    document.slide.src = images[i];
    textSlider.textContent = legendes[i]; 
    console.log(i+"  "+ "fonction precedent debut condition ");
    if (i > 0) 
         {i = i - 1;}  
    else {i = 3;}
    console.log(i+"  "+ "fonction precedent fin condition ");
    clearTimeout(myTimer);
    myTimer = setTimeout("changeImg()", time);
    console.log(i+"  "+ "fonction precedent fin");
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
