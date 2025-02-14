// script.js

var dateEvenement = new Date("April 5, 2025 00:00:00").getTime();

var x = setInterval(function() {
    var maintenant = new Date().getTime();
    var distance = dateEvenement - maintenant;

    var jours = Math.floor(distance / (1000 * 60 * 60 * 24));
    var heures = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var secondes = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("temps").innerHTML = jours + "j " + heures + "h " + minutes + "m " + secondes + "s ";

    if (distance < 0) {
        clearInterval(x);
        document.getElementById("temps").innerHTML = "C'est parti !";
    }
}, 1000);



const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.querySelector('.nav-links');

menuToggle.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});
