@extends('layouts.admin')
@section('content')
    <div class="edit mx-auto">
        <h2 class="mb-5">Modifica il tuo ristorante <span class="info">{{ $restaurant->restaurant_name }}</span> </h2>
        <div class="d-flex justify-content-end">
            <a href="{{ url()->previous() }}" class="btn btn-info">Torna indietro</a>
        </div>
        
        
        <form method="POST" class="d-flex flex-column form"
            action="{{ route('admin.restaurants.update', $restaurant->slug) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="restaurant_name">Nome Ristorante: <span class="need">*</span></label>
            <input class="mb-3 @error('restaurant_name') is-invalid @enderror" type="text" name="restaurant_name" id="restaurant_name"
                value="{{ old('restaurant_name', $restaurant->restaurant_name) }}" required>
                @error('restaurant_name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror

            <label class="info my-2" for="city">Città: <span class="need">*</span></label>
            <input class="mb-3 @error('city') is-invalid @enderror" type="text" name="city" id="city" value="{{ old('city', $restaurant->city) }}">
            @error('city')
            <div class="invalid-feedback" required>
                {{$message}}
            </div>
        @enderror

            <label for="address">Indirizzo: <span class="need">*</span></label>
            <input class="mb-3 @error('address') is-invalid @enderror" type="text" name="address" id="address"
                value="{{ old('address', $restaurant->address) }}" required>
                @error('address')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror

            <label for="phone">Telefono: <span class="need">*</span></label>
            <input class="mb-3 @error('phone') is-invalid @enderror" type="number" name="phone" id="phone"
                value="{{ old('phone', $restaurant->phone) }}">
                @error('phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror

            {{-- <label for="vat_number">P.IVA : </label>
            <input class="mb-3" type="text" name="vat_number" id="vat_number"
                value="{{ old('vat_number', $restaurant->vat_number) }}"> --}}

            <label for="closure_day">Giorno di chiusura: </label>
            <input class="mb-3 @error('closure_day') is-invalid @enderror" type="text" name="closure_day" id="closure_day"
                value="{{ old('closure_day', $restaurant->closure_day) }}">
                @error('closure_day')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror

            <p class="d-block">Seleziona categorie: <span class="need">*</span></p>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                @foreach ($categories as $category)
                    <input type="checkbox" class="btn-check  @error('category_id') is-invalid @enderror" id="{{ $category->category_name }}" autocomplete="off"
                        name="category_id[]" value="{{ $category->id }}" @checked(old('category_id') ? in_array($category->id, old('category_id', [])) : $restaurant->categories->contains($category))>
                        @error('category_id')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                        <label class="btn btn-outline-primary" for="{{ $category->category_name }}">
                            {{ $category->category_name }} </label>
                            @endforeach
            </div>

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
            
            <button type="submit" class="btn mx-auto btn-warning">Modifica</button>
        </form>
    </div>
@endsection

<style>
    
    input[type=number] {
      -moz-appearance: textfield;
    }
    
    
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    </style>
