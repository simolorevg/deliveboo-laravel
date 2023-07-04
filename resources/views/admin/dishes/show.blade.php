@extends('layouts.admin')
@section('content')
    <div class="container p-3">
        <h2 class="text-center">Info del tuo piatto: <span class="info">{{ $dish->dish_name }}</span></h2>
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.dishes.index') }}" class="btn btn-info">Torna indietro</a>
            <a class="btn btn-warning mx-1" href="{{ route('admin.dishes.edit', $dish->slug) }}">Modifica</a>
        </div>
        <ul class="list-unstyled my-5">
            <li class="my-4"><span class="info">Descrizione: </span>{{ $dish->description }}</li>
            <li class="my-4"><span class="info">Ingredienti: </span>{{ $dish->ingredients }}</li>
            <li class="my-4"><span class="info">Prezzo: </span>{{ number_format($dish->price, 2, '.', '') }} €</li>
            <li class="my-4"><span class="info">Disponibile: </span>
                @if ($dish->is_available)
                    <span>Si</span>
                @else
                    <span>No</span>
                @endif
            </li>
            <li class="my-4"><span class="info">Foto: </span>{{ $dish->thumb }}</li>
        </ul>
    </div>
@endsection
