@extends('layouts.admin')
@section('content')
    <div class="edit mx-auto">
        <form class="d-flex flex-column form" action="{{ route('admin.restaurants.update', $restaurant->slug) }}"
            method="post">
            @csrf
            @method('PUT')
            <label for="restaurant_name">Nome Ristorante: </label>
            <input class="mb-3" type="text" name="restaurant_name" id="restaurant_name"
                value="{{ old('restaurant_name', $restaurant->restaurant_name) }}">

            <label for="address">Indirizzo: </label>
            <input class="mb-3" type="text" name="address" id="address"
                value="{{ old('address', $restaurant->address) }}">

            <label for="phone">Telefono: </label>
            <input class="mb-3" type="text" name="phone" id="phone"
                value="{{ old('phone', $restaurant->phone) }}">

            {{-- <label for="vat_number">P.IVA : </label>
            <input class="mb-3" type="text" name="vat_number" id="vat_number"
                value="{{ old('vat_number', $restaurant->vat_number) }}"> --}}
            <label for="closure_day">Giorno di chiusura: </label>
            <input class="mb-3" type="text" name="closure_day" id="closure_day"
                value="{{ old('closure_day', $restaurant->closure_day) }}">

            <p>Foto:</p>

            {{-- Se il post ha l'immagine, la visulizzo --}}
            @if ($restaurant->thumb)
                <div class="my-3 ">
                    <img id="actual-thumb" width="300" src="{{ asset('storage/' . $restaurant->thumb) }}"
                        alt="{{ $restaurant->name }}">
                </div>
            @endif
            {{-- preview --}}
            <div class="d-flex justify-content-center my-3">
                <img class="d-none" id="thumb-preview" src="" alt="">
            </div>
            <button type="submit" class="btn mx-auto btn-warning">MODIFICA</button>
        </form>
    </div>
@endsection
