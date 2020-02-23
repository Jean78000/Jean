var canvasDiv = document.getElementById('canvasDiv');
canvas = document.createElement('canvas');
canvas.setAttribute('width', 357);
canvas.setAttribute('height', 200);
canvas.setAttribute('id', 'canvas');
canvasDiv.appendChild(canvas);
if (typeof G_vmlCanvasManager != 'undefined') {             // verifie que la classe est chargée         
    canvas = G_vmlCanvasManager.initElement(canvas);        // init canvas
}
context = canvas.getContext("2d");                          //context SVG

$('#canvas').mousedown(function (e) {                         // intercepteur de l'evenement
    var mouseX = e.pageX - this.offsetLeft;
    var mouseY = e.pageY - this.offsetTop;

    paint = true;                                              // le stylo est posé sur la feuille
    addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop);  // ajoute un point sur la feuille à la position de la souris
    redraw();                                                   // redessine
});

$('#canvas').mousemove(function (e) {                           // intercepteur sur l'evenement de deplacement de la souris
    if (paint) {                                                  // si le stylo est posé sur la feuille
        addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true); // ajoute un point sur la feuille à la position de la souris
        redraw();                                                 // redessine
    }
});

$('#canvas').mouseup(function (e) {                 // intercepteur sur le bouton qui est relaché
    paint = false;                                  // le stylo n'est plus sur la feuille
});

$('#canvas').mouseleave(function (e) {              // quand le curseur de la souris sort du canvas ça declenche mouseleave
    paint = false;
});

const clickX = new Array();                           // tableau qui contient tout les points
const clickY = new Array();
const clickDrag = new Array();
var paint;

function addClick(x, y, dragging) {
    clickX.push(x);
    clickY.push(y);
    clickDrag.push(dragging);
}

function redraw() {                      // redessine le parcours des points
    context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas

    context.strokeStyle = "black";                // couleur de remplissage de la ligne
    context.lineJoin = "round";                     // style de jointure entre les lignes
    context.lineWidth = 5;                          // epaisseur de la ligne

    for (var i = 0; i < clickX.length; i++) {		    // on parcourt tout les points
        context.beginPath();
        if (clickDrag[i] && i) {                        // est ce que c'est le 1er point de la ligne
            context.moveTo(clickX[i - 1], clickY[i - 1]);   // on positione le curseur au point precedent
        } else {
            context.moveTo(clickX[i] - 1, clickY[i]);    // on positionne le curseur au point en cours
        }
        context.lineTo(clickX[i], clickY[i]);        // on dessine une ligne jusqu'au point en cours
        context.closePath();                         // on ferme la ligne
        context.stroke();                            // on redessine
    }
}


// pour gerer le tactile
function putPoint(e) {
    e.preventDefault();
    var touch = e.targetTouches[0];
    let touchX = touch.clientX - canvas.getBoundingClientRect().left;
    let touchY = touch.clientY - canvas.getBoundingClientRect().top;
    if (dragging) {
        context.lineWidth = 1;
        context.lineTo(touchX, touchY);
        context.stroke();
        context.beginPath();
        context.fill();
        context.beginPath();
        context.moveTo(touchX, touchY)
    }
}

function engage(e) {
    e.preventDefault();
    dragging = true;
    putPoint(e);
}

function disengage() {
    dragging = false;
    context.beginPath();
}

canvas.addEventListener('touchstart', engage);
canvas.addEventListener('touchmove', putPoint);
canvas.addEventListener('touchend', disengage);
