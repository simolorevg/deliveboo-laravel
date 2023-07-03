@extends('layouts.admin')
@section('content')

@php
    use App\Models\Restaurant;
                            
    $restaurant = Restaurant::where("user_id" , Auth::user()->id)->get(); 
@endphp

@if (count($restaurant) == 0)
    <h2 class="mx-5">Crea il tuo risorante: se ne hai il coraggio</h2>
    <div class="mx-5">
        
        <form class="d-flex flex-column form" action="{{ route('admin.restaurants.store') }}" method="POST">
            @csrf
            <label for="restaurant_name">Nome Ristorante: </label>
            <input type="text" name="restaurant_name" id="restaurant_name">
            <label for="city">Città: </label>
            <input type="text" name="city" id="city">
            <label for="address">Indirizzo: </label>
            <input type="text" name="address" id="address">
            <label for="phone">Telefono: </label>
            <input type="text" name="phone" id="phone">
            <label for="vat_number">P.IVA : </label>
            <input type="text" name="vat_number" id="vat_number">
            <label for="closure_day">Giorno di chiusura: </label>
            <input type="text" name="closure_day" id="closure_day">
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">

                @foreach ($categories as $category)
                <input type="checkbox" class="btn-check" id="{{$category->category_name}}" autocomplete="off" name= "category_id[]" value="{{$category->id}}">
                <label class="btn btn-outline-primary" for="{{$category->category_name}}"> {{$category->category_name}}</label>
                @endforeach
    
            </div>
            <button type="submit" class="btn btn-primary">CREA</button>

        </form>
    </div>
    @else

    <h5>Hai già un ristorante associato al tuo account</h5>
        
    @endif
@endsection

