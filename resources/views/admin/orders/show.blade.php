@extends('layouts.admin')

@section('content')
    <div class="wrapper p-5">

        <div class="container p-3">

            <h2 class="text-center">Info ordine: <span class="info">{{ $order->slug }}</span></h2>
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-info">Torna indietro</a>
            </div>

            <ul class="list-unstyled my-5">

                {{-- Cliente  --}}
                <li class="my-4"><span class="info">Cliente: </span>
                    {{ $order->guest_name }} {{ $order->guest_lastname }}
                </li>

                {{-- Indirizzo --}}
                <li class="my-4"><span class="info">Indirizzo: </span>{{ $order->guest_address }}</li>

                {{-- Telefono --}}
                <li class="my-4"><span class="info">Telefono: </span>{{ $order->guest_phone }}</li>

                {{-- Email --}}
                <li class="my-4"><span class="info">Email: </span>{{ $order->guest_mail }}</li>

                {{-- Totale piatti --}}
                <li class="my-4"><span class="info">Totale piatti: </span>{{ $order->total_goods }}</li>

                {{-- Totale € --}}
                <li class="my-4"><span class="info">Totale: </span>{{ number_format($order->total, 2, '.', '') }} €
                </li>

                {{-- Saldato  --}}
                    {{-- <li class="my-4"><span class="info">Pagamento: </span>
                        @if ($order->is_paid)
                            <span>Il cliente ha saldato il conto</span>
                        @else
                        <span>Il cliente non ha saldato il conto</span>
        
                        @endif
                    </li> --}}

            </ul>
        </div>
    @endsection
