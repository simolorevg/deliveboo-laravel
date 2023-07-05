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


// // Animazione homepage , non compare errore console log in altre rotte
// function initHomepageAnimation() {
//   const h1 = document.getElementById('welcome');
//   if( h1 && h1.innerHTML === 'Benvenuto nel gestionale Ristoratori!'){
//     setTimeout(function () {
//       const welcome = document.querySelector("h1");
//       welcome.classList.add('welcome-2');
//     }, 2000);
//   }
// }
//   document.addEventListener("DOMContentLoaded", function () {
//     initHomepageAnimation();
// });
// initHomepageAnimation();

// -------------------------------------------------------------------------------------

// // Imposta la lingua su italiano
// Settings.defaultLocale = 'it';
// //funzione per visualizzare l'ora e data istantanea
// function updateDateTime() {
//   const datetimeElement = document.getElementById('datetime');
//   let now = DateTime.local();
//   if (datetimeElement){
//     datetimeElement
//     datetimeElement.textContent = `${now.toFormat('EEEE dd LLL yyyy HH:mm:ss')}`;
//   }
// }

// setInterval(updateDateTime, 1000);
// updateDateTime();


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

  check();
}


// preview EDIT immagine restaurant

let imageInputEditR = document.getElementById("image-input-editR");
let imagePreviewEditR = document.getElementById("image-preview-editR");
let imageActualEditR = document.getElementById("actual-image-editR");

if (imageInputEditR && imagePreviewEditR) {

imageInputEditR.addEventListener("change", function () {
    
    let selectedFile = this.files[0]; //files è un array di file, prendo il primo
    let reader = new FileReader();
    console.log("prova");
    
    reader.addEventListener("load", function () {
      console.log("prova");
      imagePreviewEditR.src = reader.result;
      imagePreviewEditR.classList.remove("d-none");
      imagePreviewEditR.classList.add("d-block");
      imageActualEditR.classList.add("d-none");
    })
    
    reader.readAsDataURL(selectedFile);//converte il file in una stringa di testo
  })

}


// preview CREATE immagine restaurant
let imageInputCreateR = document.getElementById("image-input-createR");
let imagePreviewCreateR = document.getElementById("image-preview-createR");

if (imageInputCreateR && imagePreviewCreateR) {
  imageInputCreateR.addEventListener("change", function (event) {
    let selectedFile = event.target.files[0]; // Ottieni il file selezionato
    let reader = new FileReader();

    reader.addEventListener("load", function () {
      imagePreviewCreateR.src = reader.result;
      imagePreviewCreateR.classList.remove("d-none");
    });

    if (selectedFile) {
      reader.readAsDataURL(selectedFile);
    }
  });
}






// let imageInputDish = document.getElementById("image-input-dish");
// let imagePreviewDish = document.getElementById("image-preview-dish");
// let imageActualDish = document.getElementById("actual-image-dish");


// if (imageInputDish && imagePreviewDish) {

//   imageInputDish.addEventListener("change", function () {
    
//     let selectedFile = this.files[0]; //files è un array di file, prendo il primo
//     let reader = new FileReader();
//     console.log("prova");
    
//     reader.addEventListener("load", function () {
//       imagePreviewDish.src = reader.result;
//       imagePreviewDish.classList.remove("d-none");
//       imagePreviewDish.classList.add("d-block");
//       imageActualDish.classList.add("d-none");
//     })
    
//     reader.readAsDataURL(selectedFile);//converte il file in una stringa di testo
//   })

// }












