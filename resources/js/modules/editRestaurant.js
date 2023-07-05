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
