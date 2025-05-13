document.addEventListener("DOMContentLoaded", function () {
    const carousel = document.querySelector(".carousel");
    const images = document.querySelectorAll(".carousel-img");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    let index = 0;
    const totalImages = images.length;

    // Funzione per aggiornare il carosello
    function updateCarousel() {
        carousel.style.transform = `translateX(${-index * 100}%)`;
    }

    // Clicca sul bottone "successivo"
    nextBtn.addEventListener("click", function () {
        if (index < totalImages - 1) {
            index++;
        } else {
            index = 0; // Torna alla prima immagine
        }
        updateCarousel();
    });

    // Clicca sul bottone "precedente"
    prevBtn.addEventListener("click", function () {
        if (index > 0) {
            index--;
        } else {
            index = totalImages - 1; // Torna all'ultima immagine
        }
        updateCarousel();
    });
});
