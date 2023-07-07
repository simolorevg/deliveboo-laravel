
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


let imageInputDish = document.getElementById("image-input-dish");
let imagePreviewDish = document.getElementById("image-preview-dish");
let imageActualDish = document.getElementById("actual-image-dish");


if (imageInputDish && imagePreviewDish) {

  imageInputDish.addEventListener("change", function () {
    
    let selectedFile = this.files[0]; //files è un array di file, prendo il primo
    let reader = new FileReader();
    console.log("prova");
    
    reader.addEventListener("load", function () {
      imagePreviewDish.src = reader.result;
      imagePreviewDish.classList.remove("d-none");
      imagePreviewDish.classList.add("d-block");
      imageActualDish.classList.add("d-none");
    })
    
    reader.readAsDataURL(selectedFile);//converte il file in una stringa di testo
  })

}


