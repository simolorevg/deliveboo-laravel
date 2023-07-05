// Animazione homepage , non compare errore console log in altre rotte
function initHomepageAnimation() {
    const h1 = document.getElementById('welcome');
    if (h1 && h1.innerHTML === 'Benvenuto nel gestionale Ristoratori!') {
        setTimeout(function () {
            const welcome = document.querySelector("h1");
            welcome.classList.add('welcome-2');
        }, 2000);
    }
}
document.addEventListener("DOMContentLoaded", function () {
    initHomepageAnimation();
});
initHomepageAnimation();


