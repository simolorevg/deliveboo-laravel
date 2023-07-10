@extends('layouts.admin')

@section('content')
<div class="wrapper p-5">

    <h2>I tuoi ordini <span class="info">{{ Auth::user()->name }}</span></h2>

    <table class="table table-dark table-hover table-striped">
        <thead>
            <tr class="text-center">
                <th scope="col">Nome </th>
                <th scope="col">Cognome </th>
                <th scope="col">Indirizzo</th>
                <th scope="col">Telefono</th>
                <th scope="col">Email</th>
                <th scope="col">Totale piatti</th>
                <th scope="col">Totale €</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($orders as $item)
                @if ($item->restaurant_id == Auth::user()->id)
                    <tr class="text-center">
                        <td scope="row">{{ $item->guest_name }}</td>
                        <td scope="row">{{ $item->guest_lastname }}</td>
                        <td scope="row">{{ $item->guest_address }}</td>
                        <td scope="row">{{ $item->guest_phone }}</td>
                        <td scope="row">{{ $item->guest_mail }}</td>
                        <td scope="row">{{ $item->total_goods }}</td>
                        <td scope="row">{{ $item->total }}</td>
                        <td scope="row" class="d-flex justify-content-center">
                            <a class="btn btn-primary mx-1"
                                href="{{ route('admin.orders.show', $item->slug) }}">Visualizza</a>
                            <form class="d-inline-block" action="{{ route('admin.orders.destroy', $item->slug) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-delete"
                                    data-dish-name="{{ $item->dish_name }}">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    {{-- <a href="{{ route('admin.stat')}}">Guarda le stat</a> --}}

    @include('admin.partials.modal_delete')
</div>
@endsection
