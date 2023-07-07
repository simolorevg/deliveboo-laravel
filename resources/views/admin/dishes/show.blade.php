@extends('layouts.admin')
@section('content')
    <div class="container p-3">

        <h2 class="text-center">Info del tuo piatto: <span class="info">{{ $dish->dish_name }}</span></h2>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.dishes.index') }}" class="btn btn-info">Torna indietro</a>
            <a class="btn btn-warning mx-1" href="{{ route('admin.dishes.edit', $dish->slug) }}">Modifica</a>
        </div>

        <ul class="list-unstyled my-5">

            {{-- Descrizione  --}}
            <li class="my-4"><span class="info">Descrizione: </span>
                @if ($dish->description)
                    <span>
                        {{ $dish->description }}
                    </span>
                @else
                    <span>Descrizione non disponibile
                    </span>
                @endif
            </li>

            {{-- Ingredienti --}}
            <li class="my-4"><span class="info">Ingredienti: </span>{{ $dish->ingredients }}</li>

            {{-- Prezzo --}}
            <li class="my-4"><span class="info">Prezzo: </span>{{ number_format($dish->price, 2, '.', '') }} €</li>

            {{-- Disponibilità --}}
            <li class="my-4"><span class="info">Disponibile: </span>
                @if ($dish->is_available)
                    <span>Si </span>
                    <span> 😏</span>
                    
                @else
                    <span>No </span>
                    <span> 😪</span>

                @endif
            </li>


            {{-- Immagine --}}
            <li class="my-4 d-flex gap-3 align-items-center">
                <span class="info">Immagine piatto:</span>
                @if ($dish->img)
                    <div class="w-50 mt-4 d-inline-block">
                        <img src="{{ asset('storage/' . $dish->img) }}" alt="{{ $dish->dish_name }}"
                            class="img-fluid w-50 ml-4">
                    </div>
                @else
                    <div class="image-not-found">
                        <img width="200px" src="{{ Vite::asset('resources/img/image_not_found.jpg')}}" alt="">
                    </div>
                @endif
            </li>
        </ul>
    </div>
@endsection
