<h1> Gentile {{$order->guest_name $order->guest_lastname }}</h1>

<p>Siamo lieti di informarti che l'ordine è stato approvato con successo</p>

<p>Di seguito i dettagli dell'ordine :</p>

<ul class="list-unstyled">

    <li>
        <span class="info">ID ordine: </span> {{$order->id}}
    </li>
    <li>
        <span class="info">Indirizzo utente: </span> {{$order->guest_address}}
    </li>
    <li>
        <span class="info">Email utente: </span> {{$order->guest_mail}}
    </li>
    <li>
        <span class="info">Telefono utente: </span> {{$order->guest_phone}}
    </li>
    <li>
        <span class="info">Quantità: </span> {{$order->pivot->quantity}}
    </li>
    <li>
        <span class="info">Totale: </span> {{$dish->pivot->quantity * $dish->price }}
    </li>
</ul>