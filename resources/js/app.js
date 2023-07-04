import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';
import { DateTime, Settings } from 'luxon';
import { Logger } from 'sass';
import { unset } from 'lodash';

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


// funzione per far scomparire create/edit/delete il messaggio progressivamente

const finalMessage = document.getElementById('final-message');
if (finalMessage) {
  console.log(finalMessage);
  function disappear() {
    finalMessage.classList.add('hide');
    setTimeout(() => {
      finalMessage.classList.add('d-none');
    }, 4000);
  }
  disappear();

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
let checkboxes = document.querySelectorAll('input[type="checkbox"].create');
const errorCategory = document.querySelector('.error-category');
let url = window.location.href;

if (btnCreate && checkboxes.length > 0) {
  if (url.includes('/admin')) {

    btnCreate.addEventListener('click', function (event) {
      console.log(url);
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
}



//validazione client side edit ristorante
let checkboxesEdit = document.querySelectorAll('input[type="checkbox"]');
let numChecked;
let nuovoarray = Array.from(document.querySelectorAll('input[type="checkbox"][checked]'));

if (checkboxesEdit) {

  function check() {
    checkboxesEdit.forEach((check) => {
      check.addEventListener('change', function () {
        numChecked = nuovoarray.length;

        if (check.checked) {
          nuovoarray.push(check);

        }
        else {
          if (nuovoarray.includes(check)) {
            let index = nuovoarray.indexOf(check)
            nuovoarray.splice(index);

          }
        }
      })
    })
  }

  btnChange.addEventListener('click', function (event) {

    if (nuovoarray.length === 0) {
      event.preventDefault();
      errorCategory.classList.remove('d-none');
      errorCategory.classList.add('d-block');
    }
  })

}











setInterval(updateDateTime, 1000);
updateDateTime();
check();
