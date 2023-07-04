import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';
import { DateTime, Settings } from 'luxon';
import { Logger } from 'sass';

import.meta.glob([
  '../img/**'
]);

// Animazione homepage
document.addEventListener("DOMContentLoaded", function () {
  setTimeout(function () {
    const welcome = document.querySelector("h1");
    welcome.classList.add('welcome-2');
  }, 2000);
});


// Imposta la lingua su italiano
Settings.defaultLocale = 'it';
//funzione per visualizzare l'ora e data istantanea
function updateDateTime() {
  const datetimeElement = document.getElementById('datetime');
  let now = DateTime.local();
  datetimeElement.textContent = `${now.toFormat('EEEE dd LLL yyyy HH:mm:ss')}`;
}



//validazione registrazione utente

let password = document.getElementById('password');
let passwordConfirm = document.getElementById('password-confirm');
let form = document.getElementById('registration-form');
let btn = document.getElementById('prova');
const errorFront = document.querySelector('.error-front');

btn.addEventListener('click', function(e){
  if(password.value !== passwordConfirm.value){
    e.preventDefault();
    errorFront.classList.remove('d-none');
    errorFront.classList.add('d-block');
    errorFront.style.color('red');
    console.log('password non uguali');
  }
  console.log(password.value, passwordConfirm.value);

})


// Modal per cancellare

const deletBtn = document.querySelectorAll('.deletBtn');
console.log(deletBtn);

//validazione client side create restaurant checkbox


//
// document.getElementById('create-restaurant-form').addEventListener('submit', function(event) {
//   let checkboxes = document.querySelectorAll('#checkboxGroup input[type="checkbox"]');
//   let checked = false;

//   for (let i = 0; i < checkboxes.length; i++) {
//     if (checkboxes[i].checked) {
//       checked = true;
//       break;
//     }
//   }

//   if (!checked) {
//     event.preventDefault(); // Previeni l'invio del modulo se nessuna checkbox è selezionata
//     alert('Seleziona almeno una checkbox.');
//   }
// });




setInterval(updateDateTime, 1000);
updateDateTime();

