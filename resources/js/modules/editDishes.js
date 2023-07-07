    
// funzione per far scomparire create/edit/delete il messaggio progressivamente

const finalMessage = document.getElementById('final-message');
if (finalMessage) {
  console.log(finalMessage);
  function disappear() {
    finalMessage.classList.add('hide');
    setTimeout(() => {
      finalMessage.classList.add('d-none');
    }, 8000);
  }
  disappear();

}

// preview EDIT immagine dishes

let imageInput = document.getElementById("image-input");
let imagePreview = document.getElementById("image-preview");
let imageActual = document.getElementById("actual-image");

imageInput.addEventListener("change", function () {
    console.log(imageInput);
    console.log(imagePreview);
    console.log(imageActual);
    let selectedFile = this.files[0]; //files è un array di file, prendo il primo
    let reader = new FileReader();
    
    reader.addEventListener("load", function () {
      imagePreview.src = reader.result;
      imagePreview.classList.remove("d-none");
      imagePreview.classList.add("d-block");
      imageActual.classList.add("d-none");
    })
    
    reader.readAsDataURL(selectedFile);//converte il file in una stringa di testo
  })

