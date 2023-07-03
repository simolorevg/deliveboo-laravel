@extends('layouts.admin')
@section('content')
    <div class="container p-3">

        <h2 class="text-center">Dettagli del tuo ristorante: <span class="info">{{ $restaurant->restaurant_name }} </span>
        </h2>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.restaurants.index') }}" class="btn btn-info">Torna indietro</a>
            <a class="btn btn-warning mx-1" href="{{ route('admin.restaurants.edit', $restaurant->slug) }}">Modifica</a>
        </div>
        <ul class="list-unstyled">
            <li class="my-4">
                <span class="info">Città:</span> {{ $restaurant->address }}
            </li>
            <li class="my-4">
                <span class="info">Indirizzo:</span> {{ $restaurant->address }}
            </li>
            <li class="my-4">
                <span class="info">Telefono:</span> {{ $restaurant->phone }}
            </li>
            <li class="my-4">
                <span class="info">P.IVA:</span> {{ $restaurant->vat_number }}
            </li>
            <li class="my-4">
                <span class="info">Giorno chiusura:</span> {{ $restaurant->closure_day }}
            </li>
            <li class="my-4">
                <span class="info">Foto:</span>
                @if (true)
                    <img src="" alt="">
                @else
                    <img src="{{ Vite::asset('resources/img/notfound.jpg') }}" alt="">
                @endif
            </li>
        </ul>
    </div>
@endsection
