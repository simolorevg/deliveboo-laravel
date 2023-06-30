@extends('layouts.app')
@section('content')
    <h2 class="text-center">{{ $restaurant->restaurant_name }}</h2>
    <ul>
        <li>Indirizzo: {{ $restautant->address }}</li>
        <li>Telefono: {{ $restaurant->phone }}</li>
        <li>P.IVA: {{ $restaurant->vat_number }}</li>
        <li>Giorno chiusura: {{ $restaurant->closure_day }}</li>
    </ul>
@endsection
