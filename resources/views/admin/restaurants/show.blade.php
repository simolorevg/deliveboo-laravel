@extends('layouts.admin')
@section('content')
    <h2 class="text-center">{{ $restaurant->restaurant_name }}</h2>
    <ul class="list-unstyled">
        <li>Indirizzo: {{ $restaurant->address }}</li>
        <li>Telefono: {{ $restaurant->phone }}</li>
        <li>P.IVA: {{ $restaurant->vat_number }}</li>
        <li>Giorno chiusura: {{ $restaurant->closure_day }}</li>
    </ul>
@endsection
