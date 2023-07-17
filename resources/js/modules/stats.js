const option = document.querySelector('#year'); // Seleziono l'elemento select tramite l'ID
const btn = document.getElementById('stat');
const ok = document.getElementById('action');
const hiden = document.getElementById('hiden'); // Seleziono l'elemento select tramite l'ID

console.log(hiden);
if (option.value === '') {
    btn.addEventListener('click', function(event) {
        if (option.value === '') {
            event.preventDefault(); // Chiamata preventDefault() quando l'opzione è "Tutti"
            hiden.classList.remove('d-none');
            hiden.classList.add('d-block');
        }
    });
}


hiden.addEventListener('click', function() {
    hiden.classList.add('d-none');
    hiden.classList.remove('d-block');
});
