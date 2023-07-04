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
let btn = document.getElementById('prova');
const errorFront = document.querySelector('.error-front');

if (password && passwordConfirm && btn && errorFront) {
  btn.addEventListener('click', function (e) {
    if (password.value !== passwordConfirm.value) {
      e.preventDefault();
      errorFront.classList.remove('d-none');
      errorFront.classList.add('d-block');
      console.log('password non uguali');
    }
    console.log(password.value, passwordConfirm.value);

  })
}

//validazione client side create restaurant checkbox
const btnCreate = document.getElementById('btn-create');
const btnChange = document.getElementById('btn-change');
let checkboxes = document.querySelectorAll('input[type="checkbox"]');
const errorCategory = document.querySelector('.error-category');


if (btnCreate && checkboxes.length > 0) {
  btnCreate.addEventListener('click', function (event) {
    console.log(window.location.href);
    let numChecked = 0;
    for (let i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        numChecked++;
      }
    }

    if (numChecked === 0) {
      event.preventDefault();
      errorCategory.classList.remove('d-none');
      errorCategory.classList.add('d-block');
    }
  });
}
//validazione client side edit ristorante
if (btnChange && checkboxes.length > 0) {
  btnChange.addEventListener('click', function (event) {
    console.log(window.location.href);
    let numChecked = 0;
    console.log('Lunghezza checkboxes: ', checkboxes.length);
    for (let i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        numChecked++;
      }
    }

    if (numChecked === 0) {
      event.preventDefault();
      errorCategory.classList.remove('d-none');
      errorCategory.classList.add('d-block');
    }
  });
}



// Modal per cancellare

const deleteBtns = document.querySelectorAll(".btn-delete");

if (deleteBtns.length > 0) {
  deleteBtns.forEach((btn) => {
    btn.addEventListener("click", function (event) {
      event.preventDefault();
      const dishName = btn.getAttribute("data-dish-name");

      const deleteModal = new bootstrap.Modal(
        document.getElementById("delete-modal")
      );
      document.getElementById("dish-name").innerText = dishName;

      document
        .getElementById("action-delete")
        .addEventListener("click", function () {
          btn.parentElement.submit();
        });

      deleteModal.show();
    });
  });
}






setInterval(updateDateTime, 1000);
updateDateTime();

