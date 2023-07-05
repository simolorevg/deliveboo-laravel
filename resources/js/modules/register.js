//validazione registrazione utente

let password = document.getElementById('password');
let passwordConfirm = document.getElementById('password-confirm');
let btn = document.getElementById('prova');
const errorFront = document.querySelector('.error-front');

if (password && passwordConfirm && btn && errorFront) {
  console.log('ciao');
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
