

window.onload = changeImg;   /*implemente changeImg*/
let myTimer;
const time = 5000;
const images = ["image/image1.PNG",
    "image/image2.JPG",
    "image/image3.JPG",
    "image/image4.JPG",];
let i;
var legendes = ['Bienvenue sur VELO CLICK', 'Vous pouvez utiliser les fleches directionelles du clavier', 'Cliquer sur un vélos là oû vous en desirez un', 'Puis remplissez le formulaire pour signer'];

function changeImg() {
    if (i < images.length - 1) {
        i++;
        document.slide.src = images[i];
        textSlider.textContent = legendes[i];
    }
    else {
        i = 0;
        document.slide.src = images[0];
        textSlider.textContent = legendes[i];
    }
    myTimer = setTimeout("changeImg()", time);
}

function suivant() {
    if (i < images.length - 1) {
        i++;
        document.slide.src = images[i];
        textSlider.textContent = legendes[i];
    }
    else {
        i = 0;
        document.slide.src = images[0];
        textSlider.textContent = legendes[i];
    }
    clearTimeout(myTimer);
    myTimer = setTimeout("changeImg()", time);
    clearTimeout(myTimer);
}

function precedent() {
    if (i > 0) {
        i = i - 1;
        document.slide.src = images[i];
        textSlider.textContent = legendes[i];
    }
    else {
        i = 3;
        document.slide.src = images[3];
        textSlider.textContent = legendes[i];
    }
    clearTimeout(myTimer);
    myTimer = setTimeout("changeImg()", time);
    clearTimeout(myTimer);
}

pause = () => {
    clearTimeout(myTimer);
    document.getElementById('pauseButton').style.visibility = 'hidden';
    document.getElementById('playButton').style.visibility = 'visible';
}

play = () => {
    clearTimeout(myTimer);
    myTimer = setTimeout("changeImg()", time);
    document.getElementById('playButton').style.visibility = 'hidden';
    document.getElementById('pauseButton').style.visibility = 'visible';
}

$(document).keydown(function (e) {
    if (e.keyCode === 37) {
        precedent();
    }
    else if (e.keyCode === 39) {
        suivant();
    }
});

