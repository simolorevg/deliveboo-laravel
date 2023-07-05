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

            {{-- Città --}}
            <li class="my-4">
                <span class="info">Città:</span> {{ $restaurant->city }}
            </li>

            {{-- Indirizzo --}}
            <li class="my-4">
                <span class="info">Indirizzo:</span> {{ $restaurant->address }}
            </li>

            {{-- Telefono --}}
            <li class="my-4">
                <span class="info">Telefono:</span> {{ $restaurant->phone }}
            </li>

            {{-- Partita IVA --}}
            <li class="my-4">
                <span class="info">P.IVA:</span> {{ $restaurant->vat_number }}
            </li>

            {{-- Giorno di chiurusa --}}
            <li class="my-4">
                <span class="info">Giorno chiusura:</span> {{ $restaurant->closure_day }}
            </li>

            {{-- Categorie --}}
            <li>
                <div class="tecno d-flex my-5 gap-4">
                    <span class="info">Cucine associate:</span>

                    @forelse ($restaurant->categories as $item)
                        <span>{{ $item->category_name }}</span>
                    @empty
                        Non ci sono categorie associate
                    @endforelse
                </div>
            </li>

            {{-- Logo --}}
            <li class="my-4 d-flex gap-3 align-items-center">
                <span class="info">Logo:</span>
                @if ($restaurant->thumb)
                    <div class="w-50 mt-4 d-inline-block">
                        <img src="{{ asset('storage/' . $restaurant->thumb) }}" alt="{{ $restaurant->restaurant_name }}"
                            class="img-fluid w-50 ml-4">
                    </div>
                @else
                    <div class="p-5 w-50 bg-secondary text-white">
                        IMMAGINE NON PRESENTE
                    </div>
                @endif
            </li>
        </ul>
    </div>
@endsection
