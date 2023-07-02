import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';
import { DateTime, Settings } from 'luxon';

import.meta.glob([
  '../img/**'
]);

document.addEventListener("DOMContentLoaded", function () {
  setTimeout(function () {
    const welcome = document.querySelector("h1");
    welcome.classList.add('welcome-2');
  }, 2000);
});


// Imposta la lingua su italiano
Settings.defaultLocale = 'it';
//funzione per visualizzare l'ora e data in diretta
function updateDateTime() {
  const datetimeElement = document.getElementById('datetime');
  let now = DateTime.local();
  datetimeElement.textContent = `${now.toFormat('EEEE dd LLL yyyy HH:mm:ss')}`;
}

setInterval(updateDateTime, 1000);
updateDateTime();
