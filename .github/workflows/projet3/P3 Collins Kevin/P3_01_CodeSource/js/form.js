
signer = () => {
    $('#myModal').modal('hide');

    let modalVeloDispo = "Il n'y a plus de vélo dispo";
    let modalBodyText = "Veuillez choisir une autre station";
    if (veloDispo == 0) {
        exampleModalLongTitle.textContent = modalVeloDispo;
        modalBody.textContent = modalBodyText;
        $('#myModal').modal('show');
    }

    let titreSignFailed = "Signature manquante";
    let bodySignFailed = "Veuillez signer svp";

    if (canvas.count < 20) {
        exampleModalLongTitle.textContent = titreSignFailed;
        modalBody.textContent = bodySignFailed;
        $('#myModal').modal('show');
    }


    if (canvas.count >= 20) {
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

        window.scrollBy(0, 300);   // centrer la vue sur la reservation

        clearInterval(countdownTimer);
        countdownTimer = setInterval('timer()', 1000);
        current_level = 1200;
    }

}


storage = () => {
    let ls = localStorage.getItem('surname');
    document.getElementById('surnameStorage').value = ls;
    let ls1 = localStorage.getItem('name');
    document.getElementById('nameStorage').value = ls1;         // Pour garder les infos dans le bulletin de reservation
    let ls2 = sessionStorage.getItem('adresse');
    document.getElementById('adressStorage').value = ls2;

    let ls5 = localStorage.getItem('surname');              // Pour garder nom/prenom dans le 1er formulaire
    document.getElementById('surname').value = ls5;
    let ls6 = localStorage.getItem('name');
    document.getElementById('name').value = ls6;
}
storage();



if (window.matchMedia("(max-width: 500px)").matches) {
    document.querySelector('.stationDetail').textContent = "Details";
    document.querySelector('.title').textContent = "Reservation";
    document.querySelector('.menu').style.display = "none";

    $('#hamburgerButton').click(function () {
        $('.menu').slideToggle();
    });

    let mobilePosition = document.getElementById("titreEtMenu");


    window.addEventListener('scroll', function (e) {
        if (window.scrollY >= 320) {
            mobilePosition.style.position = "fixed"
            document.querySelector('.mobile').style.display = "none"
        }
        else { mobilePosition.style.position = "relative" }
    }
    )
}



