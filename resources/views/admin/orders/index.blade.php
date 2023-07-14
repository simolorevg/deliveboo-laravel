@extends('layouts.admin')

@section('content')
    <div class="wrapper p-5">

        <h2 class="mb-3">I tuoi ordini <span class="info">{{ Auth::user()->name }}</span></h2>

        @if (count($paginatedOrders) === 0)
            <h3 class="my-5 none">Spiacenti non hai ricevuto ancora nessun ordine, abbi fiducia, arriveranno...</h3>
            
        @else
        <div class="my-4 d-flex justify-content-end">

            <a class="btn btn-primary mx-1" href="{{ route('admin.orders.index') }}">Guarda le stats</a>
        </div>
            
        <table class="table table-dark table-hover table-striped">
            <thead>
                <tr class="text-center">
                    <th scope="col">N. </th>
                    <th scope="col">Nome </th>
                    <th scope="col">Cognome </th>
                    <th scope="col">Data di creazione </th>
                    <th scope="col">Indirizzo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Email</th>
                    {{-- <th scope="col">Totale piatti</th> --}}
                    {{-- <th scope="col">Totale €</th> --}}
                    <th scope="col">Azioni</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($paginatedOrders as $item)
                    {{-- @if ($item->restaurant_id == Auth::user()->id) --}}
                    <tr class="text-center">
                        <td scope="row">{{ $item->id }}</td>
                        <td scope="row">{{ $item->guest_name }}</td>
                        <td scope="row">{{ $item->guest_lastname }}</td>
                        <td scope="row">{{ $item->created_at }}</td>
                        <td scope="row">{{ $item->guest_address }}</td>
                        <td scope="row">{{ $item->guest_phone }}</td>
                        <td scope="row">{{ $item->guest_mail }}</td>
                        {{-- <td scope="row">{{ $item->total_goods }}</td> --}}
                        {{-- <td scope="row">{{ $item->total }}</td> --}}
                        {{-- <td scope="row">{{ $item->total }}</td> --}}
                        <td scope="row" class="d-flex justify-content-center">
                            <a class="btn btn-primary mx-1" href="{{ route('admin.orders.show', $item) }}">Visualizza</a>
                        </td>
                    </tr>
                    {{-- @endif --}}
                @endforeach
            </tbody>
        </table>
        {{ $paginatedOrders->links() }}
        @endif


        
        {{-- @include('admin.partials.modal_delete') --}}
    </div>
@endsection
