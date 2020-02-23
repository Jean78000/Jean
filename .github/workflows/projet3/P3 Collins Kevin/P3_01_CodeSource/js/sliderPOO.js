class Slider {
    constructor(imagesArray, legendArray, time) {
        this.images = imagesArray;
        this.legendes = legendArray;
        this.time = time;
        this.index = 0;
        this.src = document.slide;
        this.text = textSlider;
        this.timer;
        this.addKeyListener();
        this.play();
    }

    changeImg() {
        if (this.index < this.images.length - 1) {
            this.index++;
            this.src.src = this.images[this.index];
            this.text.textContent = this.legendes[this.index];
        }
        else {
            this.index = 0;
            this.src.src = this.images[this.index];
            this.text.textContent = this.legendes[this.index];
        }
        this.timer = setTimeout(this.changeImg.bind(this), this.time)
    }

    suivant() {
        if (this.index < this.images.length - 1) {
            this.index++;
            this.src.src = this.images[this.index];
            this.text.textContent = this.legendes[this.index];
        }
        else {
            this.index = 0;
            this.src.src = this.images[this.index];
            this.text.textContent = this.legendes[this.index];
        }
        this.pause();
        this.play();
    }

    precedent() {
        if (this.index > 0) {
            this.index = this.index - 1;
            this.src.src = this.images[this.index];
            this.text.textContent = this.legendes[this.index];
        }
        else {
            this.index = 5;
            this.src.src = this.images[5];
            this.text.textContent = this.legendes[this.index];
        }
        this.pause();
        this.play();
    }

    pause() {
        clearTimeout(this.timer);
        document.getElementById('pauseButton').style.visibility = 'hidden';
        document.getElementById('playButton').style.visibility = 'visible';
    }

    play() {
        clearTimeout(this.timer);
        this.timer = setTimeout(this.changeImg.bind(this), this.time)
        document.getElementById('playButton').style.visibility = 'hidden';
        document.getElementById('pauseButton').style.visibility = 'visible';
    }

    addKeyListener() {
        $(document).keydown((e) => {
            if (e.keyCode === 37) {
                this.precedent();
            } else if (e.keyCode === 39) {
                this.suivant();
            }
        });
    }
}



let slider;

window.addEventListener('load', function () {
    const images = ["image/image1.jpg",
        "image/image12.png",
        "image/image2.png",
        "image/image3.png",
        "image/image4.png",
        "image/image5.png"
    ];

    var legendes = ['Si vous souhaitez reserver un vélo à Bruxelles :','Vous pouvez utiliser les fleches droite et gauche du clavier', 'Cliquer sur la station de votre choix', 'Puis indiquer votre nom et prenom', 'Cliquer sur reserver pour ensuite signer et valider votre reservation', 'Votre reservation est valable 20 minutes'];

slider = new Slider(images, legendes, 5000);
})



