@extends('layouts.admin')
@section('content')

    @php
        use App\Models\Restaurant;
        
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->get();
    @endphp

    @if (count($restaurant) == 0)
        <div class="container-create-restaurant">

            <h2 class="mx-5">Crea il tuo ristorante</h2>
            <div class="mx-5">

                <form class="d-flex flex-column form" action="{{ route('admin.restaurants.store') }}" method="POST">
                    @csrf
                    <label class="info my-2" for="restaurant_name">Nome Ristorante: </label>
                    <input type="text" name="restaurant_name" id="restaurant_name">
                    <label class="info my-2" for="city">Città: </label>
                    <input type="text" name="city" id="city">
                    <label class="info my-2" for="address">Indirizzo: </label>
                    <input type="text" name="address" id="address">
                    <label class="info my-2" for="phone">Telefono: </label>
                    <input type="text" name="phone" id="phone">
                    <label class="info my-2" for="vat_number">P.IVA : </label>
                    <input type="text" name="vat_number" id="vat_number">
                    <label class="info my-2" for="closure_day">Giorno di chiusura: </label>
                    <input type="text" name="closure_day" id="closure_day">
                    <p class="info my-2">Categorie:</p>
                    <div class="btn-group d-flex flex-wrap mb-4 gap-2 " role="group" aria-label="Basic checkbox toggle button group">
                        @foreach ($categories as $category)
                            <input type="checkbox" class="btn-check" id="{{ $category->category_name }}" autocomplete="off"
                                name="category_id[]" value="{{ $category->id }}">
                            <label class="btn btn-outline-primary " for="{{ $category->category_name }}">
                                {{ $category->category_name }}</label>
                        @endforeach

                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Crea</button>
                        <a href="{{ route('admin.dashboard')}}" class="btn btn-warning">Annulla</a>
                    </div>

                </form>
            </div>
        @else
            <h5>Hai già un ristorante associato al tuo account</h5>
    @endif
    </div>
@endsection
