@extends('layouts.app')
@section('content')
    <h1 class="text-center">Crea il tuo risorante: se ne hai il coraggio</h1>
    <form action="{{ route('admin.restaurants.store') }}" method="POST">
        @csrf
        <label for="restaurant_name">Nome Ristorante: </label>
        <input type="text" name="restaurant_name" id="restaurant_name">
        <label for="address">Indirizzo: </label>
        <input type="text" name="address" id="address">
        <label for="phone">Telefono: </label>
        <input type="text" name="phone" id="phone">
        <label for="vat_number">P.IVA : </label>
        <input type="text" name="vat_number" id="vat_number">
        <label for="closure_day">Quando chiudi? </label>
        <input type="text" name="closure_day" id="closure_day">
        <button type="submit" class="btn btn-primary">CREA</button>
    </form>
@endsection
