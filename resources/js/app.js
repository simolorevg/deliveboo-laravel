import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import '@fortawesome/fontawesome-free/css/all.css';

import.meta.glob([
    '../img/**'
])


// transizione homepage

document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
      const welcome = document.querySelector("h1");
      welcome.classList.add('welcome-2');
    }, 2000);
  });
  