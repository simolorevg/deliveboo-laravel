Inizio :

- dare una panoramica generale all'app front, con i ristoranti popolati, e i piatti popolati, e il responsive

- andare in back-end, dare la dimostrazione di creazione ristorante, modifica, validazioni front & back, far notare l'impossibilità di creare un account con stessa email e stesso nome ristorante, inoltre se si scrive l'url admin/create/restaurant se gia ce l'ha, compare la scritta "gia ce l'hai"

- creare qualche piatto, mostrare le regole di validazione front & back, e far notare l'impossibilità di creare 2 piatti con stesso nome nello stesso ristorante

- mostrare qualche CRUD sia di ristornati che di piatti, far notare i messaggi a scomparsa di effettiva crud avvenuta

- fare simulazione di 403 e 404

- una volta creato un ristorante da 0 con 3 piatti, tornare nel front end

- far partire il caricamento di tutti i ristoranti

- simulare un ordine, e far notare la persistenza del carrello, accenando la tecnologia usata cioe localstorage

                localStorage è un'API JavaScript che consente di memorizzare dati in modo persistente nel browser web. Ecco una sintesi delle sue caratteristiche principali:
                z
                Memorizzazione basata su chiave-valore.
                Limiti di archiviazione di circa 5 MB.
                Persistenza dei dati anche dopo la chiusura del browser o il riavvio del dispositivo.
                Accesso limitato al dominio che ha creato i dati.
                API semplice con i metodi setItem(key, value) per salvare un valore, getItem(key) per recuperarlo, removeItem(key) per rimuoverlo e clear() per rimuovere tutti i dati.

- tentare di mettere articoli di diversi ristoranti ne lcarrel, e deve uscire l'errore

- simulare il 404

- simulare pagamento e far vedere le email di conferma

- ritornare nel back, far vedere la sezione ordini, e poi le stats
















controllare edit restaurant stesso nome ristorante + 
controllare 404 su admin/dfdffds @php

use App\Models\Restaurant;



$restaurant = Restaurant::where('user_id', Auth::user()->id)->get();

//    dd($restaurant);



@endphp

controllare old in edit/create dish

controllare 404