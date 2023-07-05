import { DateTime, Settings } from 'luxon';

// Imposta la lingua su italiano
Settings.defaultLocale = 'it';
//funzione per visualizzare l'ora e data istantanea
function updateDateTime() {
    const datetimeElement = document.getElementById('datetime');
    let now = DateTime.local();
    if (datetimeElement) {
        datetimeElement
        datetimeElement.textContent = `${now.toFormat('EEEE dd LLL yyyy HH:mm:ss')}`;
    }
}

setInterval(updateDateTime, 1000);
updateDateTime();