@extends('layouts.admin')

@section('content')
    <div class="wrapper p-5">

        <div class="container p-3">

            <h2 class="text-center info">Info ordine: </h2>
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.orders.index') }}" class="btn mb-5 btn-info">Torna indietro</a>
            </div>


            <table class="table table-dark table-hover table-striped">
                <thead>
                    <tr class="text-center">
                        <th scope="col">N. </th>
                        <th scope="col">Nome Piatto </th>
                        <th scope="col">Quantità </th>
                        <th scope="col">Prezzo unitario €</th>
                        <th scope="col">Totale €</th>

                    </tr>
                </thead>

                <tbody>

                    @foreach ($order->dishes as $dish)
                        <tr class="text-center">
                            <td scope="row">{{ $dish->id }}</td>
                            <td scope="row">{{ $dish->dish_name }}</td>
                            <td scope="row">{{ $dish->pivot->quantity }}</td>
                            <td scope="row"> {{ $dish->price }}</td>
                            <td scope="row">{{($dish->pivot->quantity * $dish->price )}}</td>
                    @endforeach

                </tbody>
            </table>

        </div>
    @endsection
