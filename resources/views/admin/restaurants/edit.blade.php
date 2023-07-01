@extends('layouts.admin')
@section('content')
    <div class="mx-5">
        <form class="d-flex flex-column form" action="{{ route('admin.restaurants.update', $restaurant->slug) }}"
            method="post">
            @csrf
            @method('PUT')
            <label for="restaurant_name">Nome Ristorante: </label>
            <input type="text" name="restaurant_name" id="restaurant_name"
                value="{{ old('restaurant_name', $restaurant->restaurant_name) }}">
            <label for="address">Indirizzo: </label>
            <input type="text" name="address" id="address" value="{{ old('address', $restaurant->address) }}">
            <label for="phone">Telefono: </label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $restaurant->phone) }}">
            <label for="vat_number">P.IVA : </label>
            <input type="text" name="vat_number" id="vat_number"
                value="{{ old('vat_number', $restaurant->vat_number) }}">
            <label for="closure_day">Quando chiudi? </label>
            <input type="text" name="closure_day" id="closure_day"
                value="{{ old('closure_day', $restaurant->closure_day) }}">
            <button type="submit" class="btn btn-warning">MODIFICA</button>
        </form>
    </div>
@endsection
