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

                <form class="d-flex flex-column form" action="{{ route('admin.restaurants.store') }}" method="POST"
                    id="create-restaurant" enctype="multipart/form-data">
                    @csrf

                    {{-- nome ristorante --}}
                    <label class="info my-2" for="restaurant_name">Nome Ristorante: <span class="need">*</span></label>
                    <input class="@error('restaurant_name') is-invalid @enderror" type="text" name="restaurant_name"
                        id="restaurant_name" value="{{ old('restaurant_name') }}" required>
                    @error('restaurant_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    {{-- città --}}
                    <label class="info my-2 @error('city') is-invalid @enderror" for="city">Città: <span
                            class="need">*</span></label>
                    <input type="text" name="city" id="city" value="{{ old('city') }}" required>
                    @error('city')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    {{-- indirizzo --}}
                    <label class="info my-2 @error('address') is-invalid @enderror" for="address">Indirizzo: <span
                            class="need">*</span></label>
                    <input type="text" name="address" id="address" value="{{ old('address') }}" required>
                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    {{-- telefono --}}
                    <label class="info my-2 @error('phone') is-invalid @enderror" for="phone">Telefono: <span
                            class="need">*</span></label>
                    <input type="number" name="phone" id="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    {{-- partita iva --}}
                    <label class="info my-2 @error('vat_number') is-invalid @enderror" for="vat_number">P.IVA : <span
                            class="need">*</span></label>
                    <input pattern="[0-9]{11}" type="tel" name="vat_number" id="vat_number"
                        class="@error('vat_number') is-invalid @enderror" value="{{ old('vat_number') }}" required>
                    @error('vat_number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                    {{-- Giorno di chiusura --}}
                    <label class="info my-2" for="closure_day">Giorno di chiusura: </label>
                    <input type="text" name="closure_day" id="closure_day" value="{{ old('closure_day') }}">

                    {{-- categorie --}}
                    <p class="info my-2">Categorie: <span class="need">*</span></p>
                    <div class="btn-group d-flex flex-wrap mb-4 gap-2" id="checkboxGroup" role="group"
                        aria-label="basic checkbox toggle button group">
                        @foreach ($categories as $category)
                            <input type="checkbox" class="btn-check create @error('category_id') is-invalid @enderror"
                                id="{{ $category->category_name }}" autocomplete="off" name="category_id[]"
                                value="{{ $category->id }}" @checked(in_array($category->id, old('categories', [])))>
                            <label class="btn btn-outline-primary " for="{{ $category->category_name }}">
                                {{ $category->category_name }}</label>
                        @endforeach
                        @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <span class="error-category d-none">Selezione almeno una categoria </span>

                    </div>

                    {{-- immagine --}}
                    <div class="my-3 w-50 mx-auto">
                        <label for="image-input-createR" class="form-label">Carica immagine</label>
                        <input type="file" class="form-control" id="image-input-createR" name="thumb">
                        {{-- preview --}}
                        <div class="d-flex justify-content-center my-3">
                            <img class="d-none" id="image-preview-createR" src="" alt="">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" id="btn-create" class="btn btn-primary">Crea</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">Annulla</a>
                    </div>

                </form>
            </div>
        @else
            <h5>Hai già un ristorante associato al tuo account</h5>
    @endif
    </div>
@endsection

@section('script')
    @vite(['resources/js/modules/createRestaurant.js'])
@endsection