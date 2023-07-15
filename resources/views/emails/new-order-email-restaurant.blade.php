<h1> Gentile {{ $order->dishes()->first()->restaurant->user->name}}</h1>


<p>Siamo lieti di informarti che è stato creato un ordine con successo</p>

<p>Di seguito i dettagli dell'ordine :</p>

<ul class="list-unstyled">

    <li>
        <span class="info">ID ordine: </span> {{ $order->id }}
    </li>
    <li>
        <span class="info">Nome e cognome: </span> {{ $order->guest_name }} {{$order->guest_lastname }}
    </li>
    <li>
        <span class="info">Indirizzo del cliente: </span> {{ $order->guest_address }}
    </li>
    <li>
        <span class="info">Email cliente: </span> {{ $order->guest_mail }}
    </li>
    <li>
        <span class="info">Telefono cliente: </span> {{ $order->guest_phone }}
    </li>
</ul>

<p>L'ordine è composto da {{ count($order->dishes) }} tipologie di piatti, nello specifico:</p>

<table class="table table-striped">
    <thead>
        <tr class="text-center">
            <th scope="col">Nome </th>
            <th scope="col">Quantità </th>
            <th scope="col">Prezzo unitario €</th>
            <th scope="col">Totale €</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($order->dishes as $item)
            <tr class="text-center">
                <td class="text-center" scope="row">{{ $item->dish_name }}</td>
                <td class="text-center" scope="row">{{ $item->pivot->quantity }}</td>
                <td class="text-center" scope="row">{{ $item->price }}</td>
                <td class="text-center" scope="row">{{ $item->pivot->quantity * $item->price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


<style>
    ul {
        list-style-type: none;

    }

    li::before {
        content: '🎃'
    }

    table {
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
    }
</style>
