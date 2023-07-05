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



//validazione client side edit ristorante
let checkboxesEdit = document.querySelectorAll('input[type="checkbox"]');
let numChecked;
let nuovoarray = Array.from(document.querySelectorAll('input[type="checkbox"][checked]'));
const btnChange = document.getElementById('btn-change');
const errorCategory = document.querySelector('.error-category');

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
