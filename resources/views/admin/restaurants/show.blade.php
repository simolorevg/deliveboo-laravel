@extends('layouts.admin')
@section('content')
    <h2 class="text-center">{{ $restaurant->restaurant_name }}</h2>
    <ul class="list-unstyled">
        <li class="my-5">
            <span class="info">Indirizzo:</span> {{ $restaurant->address }}
        </li>
        <li class="my-5">
            <span class="info">Telefono:</span> {{ $restaurant->phone }}
        </li>
        <li class="my-5">
            <span class="info">P.IVA:</span> {{ $restaurant->vat_number }}
        </li>
        <li class="my-5">
            <span class="info">Giorno chiusura:</span> {{ $restaurant->closure_day }}
        </li>
        <li class="my-5">
            <span class="info">Foto:</span>
            @if (true)
                <img src="" alt="">
            @else
                <img src="{{ Vite::asset('resources/img/notfound.jpg') }}" alt="">
            @endif
        </li>
    </ul>
@endsection
