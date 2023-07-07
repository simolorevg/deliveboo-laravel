
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
// preview CREATE immagine dishes
let imageInput = document.getElementById("image-input");
let imagePreview = document.getElementById("image-preview");

if (imageInput && imagePreview) {
  imageInput.addEventListener("change", function (event) {
    let selectedFile = event.target.files[0]; // Ottieni il file selezionato
    let reader = new FileReader();

    reader.addEventListener("load", function () {
      imagePreview.src = reader.result;
      imagePreview.classList.remove("d-none");
    });

    if (selectedFile) {
      reader.readAsDataURL(selectedFile);
    }
  });
}