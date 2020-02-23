let current_level;
let countdownTimer = null;    // faire savoir que la variable existe

if (sessionStorage.getItem('timer')) {
    current_level = Math.round((sessionStorage.getItem('timer') - Date.now()) / 1000);
    countdownTimer = setInterval('timer()', 1000);
} else {
    current_level = 1200;
}


timer = () => {

    let days = Math.floor(current_level / 86400);
    let remainingDays = current_level - (days * 86400);

    let hours = Math.floor(remainingDays / 3600);
    let remainingHours = remainingDays - (hours * 3600);

    let minutes = Math.floor(remainingHours / 60);
    let remainingMinutes = remainingHours - (minutes * 60);

    let seconds = remainingMinutes;
    current_level--;
    document.getElementById("timer").innerHTML = "Validitée de la reservation : " + minutes + " minutes " + " et " + seconds + " secondes";

    if (window.matchMedia("(max-width: 500px)").matches) {
        document.getElementById("timer").textContent = "Validitée : " + minutes + " min " + " et " + seconds + " s";
    }


    var timesExp = (current_level * 1000) + Date.now();
    sessionStorage.setItem('timer', timesExp);
    var compare = (timesExp - Date.now());

    if (parseInt(compare) <= 0) {
        clearInterval(countdownTimer);
        sessionStorage.removeItem('adresse');
        sessionStorage.removeItem('placeDispo');
        sessionStorage.removeItem('veloDispo');
        sessionStorage.removeItem('timer');
        localStorage.removeItem('name');
        localStorage.removeItem('surname');
        $('#name').val() == ("");
        $('#surname').val() == ("");
        $('#nameStorage').val() == ("");
        $('#surnameStorage').val() == ("");
        $('#adressStorage').val() == ("");
        document.getElementById('timer').innerHTML = "La session est expirée";
    }
}

let nomManquantTitre = "Champ Nom vide"
let prenomManquantTitre = "Champ Prenom vide"
let nomManquant = "Veuillez renseigner votre nom";
let PrenomManquant = "Veuillez renseigner votre prenom";

$('#myConfirmModal').modal('hide');

booking = () => {
    document.getElementById('signature').style.display = 'block';
    canvas.updateSize();
    window.scrollBy(0, 300);
    if (window.matchMedia("(max-width: 500px)").matches) {
        window.scrollBy(0, 150);
    }
    if ($('#name').val() == ("")) {
        exampleModalLongTitle.textContent = nomManquantTitre;
        modalBody.textContent = nomManquant;
        $('#myModal').modal('show');
    }
    if ($('#surname').val() == ("")) {
        exampleModalLongTitle.textContent = prenomManquantTitre;
        modalBody.textContent = PrenomManquant;
        $('#myModal').modal('show');
    }
    if (sessionStorage.key('formAddress') !== null) {
        $('#myConfirmModal').modal('show');
        $(document).ready(function () {
            $('#MConfirmYes').click(function () {
                sessionStorage.removeItem('adresse');
                $('#adresse').val("");
                $('#adressStorage').val("");
            });
        });
    }

}
