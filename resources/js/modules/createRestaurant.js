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

//validazione client side create restaurant checkbox
const btnCreate = document.getElementById('btn-create');
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
