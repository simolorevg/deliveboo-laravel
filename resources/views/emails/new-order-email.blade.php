<h1> Gentile {{ $order->guest_name }} {{ $order->guest_lastname }}</h1>

<p>Siamo lieti di informarti che l'ordine è stato approvato con successo</p>

<p>Di seguito i dettagli dell'ordine :</p>

<ul class="list-unstyled">

    <li>
        <span class="info">ID ordine: </span> {{ $order->id }}
    </li>
    <li>
        <span class="info">Indirizzo: </span> {{ $order->guest_address }}
    </li>
    <li>
        <span class="info">Email: </span> {{ $order->guest_mail }}
    </li>
    <li>
        <span class="info">Telefono: </span> {{ $order->guest_phone }}
    </li>
</ul>
<p>Il tuo ordine è composto da {{ count($order->dishes) }} tipologie di piatti, nello specifico:</p>

<table class="table table-striped">
    <thead>
        <tr class="text-center">
            <th scope="col">Nome </th>
            <th scope="col">Quantità </th>
            <th scope="col">Prezzo unitario €</th>
            <th scope="col">Pariale €</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalParziale = 0;
        @endphp

        @foreach ($order->dishes as $item)
            @php
                $parziale = $item->pivot->quantity * $item->price;
                $totalParziale += $parziale;
            @endphp
            <tr class="text-center">
                <td class="text-center" scope="row">{{ $item->dish_name }}</td>
                <td class="text-center" scope="row">{{ $item->pivot->quantity }}</td>
                <td class="text-center" scope="row">{{ $item->price }}</td>
                <td class="text-center" scope="row">{{ $item->pivot->quantity * $item->price }}</td>
            </tr>
        @endforeach
        <tr class="text-center">
            <td colspan="3"><strong class="total ">Totale €</strong></td>
            <td class="text-center"><strong>{{ $totalParziale }}</strong></td>
        </tr>
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

    .total {
        display: flex;
        justify-content: center;
    }
</style>
