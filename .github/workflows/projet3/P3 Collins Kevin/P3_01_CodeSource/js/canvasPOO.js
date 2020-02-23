class Canvas {
    constructor(emplacement) {
        this.div = document.querySelector(emplacement);
        this.canvas = document.createElement('canvas');
        this.canvas.setAttribute('id', 'canvas');
        this.div.appendChild(this.canvas);
        this.cont = this.canvas.getContext("2d");

        this.signer = false;
        this.canvas.width = this.canvas.clientWidth;
        this.canvas.height = this.canvas.clientHeight;
        this.canvas.width = 357;
        this.canvas.height = 200;
        this.cont.lineWidth = 2;
        this.cont.strokeStyle = "#000";
        this.count = 0;

        //les evenements
        //tactile pour le mobile
        this.canvas.addEventListener("touchstart", this.touchstart.bind(this));  
        this.canvas.addEventListener("touchmove", this.touchmove.bind(this));
        this.canvas.addEventListener("touchend", this.touchend.bind(this));

        //desktop
        this.canvas.addEventListener("mousedown", this.demarrer.bind(this));
        //arreter de dessigner
        this.canvas.addEventListener("mouseup", this.arreter.bind(this));
        //le tracer du dessin
        this.canvas.addEventListener("mousemove", this.dessiner.bind(this));
        this.canvas.addEventListener("mouseleave", this.arreter.bind(this));
        window.addEventListener("resize", this.updateSize.bind(this));      // recalibre le canvas en cas de retrecissement de la fenetre
    }


    //les methodes
    touchstart(e) {
        e.preventDefault();
        this.demarrer(e);
    }

    touchmove(e) {
        e.preventDefault();
        this.dessiner(e);
    }

    touchend(e) {
        e.preventDefault();
        this.arreter(e);
    }

    demarrer(e) {
        this.signer = true;
        this.dessiner(e);
    }

    arreter(e) {
        this.signer = false;
        this.cont.beginPath();
    }

    dessiner(e) {
        e.preventDefault();   // le comportement par default du navigateur n'est pas effectué
        let x, y;
        if (e.type == "touchstart" || e.type == "touchmove") {
            let touch = e.targetTouches[0];
            x = touch.clientX - this.canvas.getBoundingClientRect().left;   // renvoi la position absolue de la souris sur l'ecran - le rectangle le plus petit encadrant le canvas
            y = touch.clientY - this.canvas.getBoundingClientRect().top;
        }
        else {
            x = e.offsetX;
            y = e.offsetY;
        }
        if (!this.signer) return;   // si on est pas entrain de dessiner ,on sort de la fonction
        this.cont.lineTo(x, y);
        this.cont.stroke();
        this.cont.beginPath();          // créer un nouveau chemin
        this.cont.moveTo(x, y);
        this.count++;                   //compteur pour verifier la taille de la signature saisie par l'utilisateur

    }

    effacer() {
        this.cont.clearRect(0, 0, this.canvas.width, this.canvas.height);               // nettoie le canvas
        sessionStorage.removeItem('adresse');
        sessionStorage.removeItem('veloDispo');
        sessionStorage.removeItem('placeDispo');
        sessionStorage.removeItem('timer');
        localStorage.removeItem('name');
        localStorage.removeItem('surname');                 // on efface toutes les infos (du storage et des formulaires)
        clearInterval(countdownTimer);                      // et met le compteur à 0
        $('#surnameStorage').val("");
        $('#nameStorage').val("");
        $('#adressStorage').val("");
        $('#placeDispo').val("");
        $('#veloDispo').val("");
        document.getElementById('timer').innerHTML = "La session est expirée";
        this.count = 0;
    }

    updateSize() {
        this.canvas.width = this.canvas.clientWidth;        // pour que le canvas est la taille réel defini par le css
        this.canvas.height = this.canvas.clientHeight;
    }
}


let canvas = new Canvas("#canvasDiv"); 

