@extends('layouts.admin')
@section('content')

    @php
        use App\Models\Restaurant;
        
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->get();
    @endphp

    @if (count($restaurant) == 0)
        <div class="container-create-restaurant card">
            <div class="card-header">
                <h4 class="text-center">Crea il tuo ristorante</h4>
            </div>
            <div class="mx-5 card-body">

                <form class="form d-flex flex-column" action="{{ route('admin.restaurants.store') }}" method="POST" id="create-restaurant"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- nome ristorante --}}
                    <label class="info col-md-4 col-form-label" for="restaurant_name">Nome Ristorante: <span
                            class="need">*</span></label>
                    <div class="col-md-6 div-input">
                        <input class="form-control @error('restaurant_name') is-invalid @enderror" type="text"
                            name="restaurant_name" id="restaurant_name" value="{{ old('restaurant_name') }}" required
                            minlength="3" maxlength="20">
                        @error('restaurant_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- città --}}
                    <label class="info col-md-4 col-form-label" for="city">Città: <span
                            class="need">*</span></label>
                    <div class="col-md-6 div-input">

                        <input type="text" class="form-control @error('city') is-invalid @enderror" name="city"
                            id="city" value="{{ old('city') }}" required minlength="3" maxlength="20">
                        @error('city')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- indirizzo --}}
                    <label class="info col-md-4 col-form-label " for="address">Indirizzo: <span
                            class="need">*</span></label>
                    <div class="col-md-6 div-input">
                        <input type="text" name="address" id="address"
                            class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}"
                            required minlength="3" maxlength="20">
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- telefono --}}
                    <label class="info col-md-4 col-form-label " for="phone">Telefono: <span
                            class="need">*</span></label>
                    <div class="col-md-6 div-input">
                        <input type="number" name="phone" id="phone"
                            class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required
                            minlength="9" maxlength="11">
                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- partita iva --}}
                    <label class="info col-md-4 col-form-label" for="vat_number">P.IVA : <span
                            class="need">*</span></label>
                    <div class="col-md-6 div-input">
                        <input pattern="[0-9]{11}" type="tel" name="vat_number" id="vat_number"
                            class="@error('vat_number') is-invalid @enderror form-control" value="{{ old('vat_number') }}"
                            required>
                        @error('vat_number')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Giorno di chiusura --}}
                    <label class="info col-md-4 col-form-label" for="closure_day">Giorno di chiusura: </label>
                    <div class="col-md-6 div-input">
                        <input type="text" name="closure_day" id="closure_day" class="form-control"
                            value="{{ old('closure_day') }}">
                    </div>

                    {{-- categorie --}}
                    <p class="info col-md-4 col-form-label">Categorie: <span class="need">*</span></p>
                    <div class="col-md-6 div-input">
                        <span class="error-category my-2 d-none">Selezione almeno una categoria </span>
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
                        </div>
                    </div>

                    {{-- immagine --}}
                    <label for="image-input-createR" class="info form-label">Carica immagine:</label>                    <div class="col-md-6 div-input">
                        <input type="file" class="form-control" id="image-input-createR" name="thumb">
                        {{-- preview --}}
                        <div class="d-flex justify-content-center my-3">
                            <img class="d-none" width="300" id="image-preview-createR" src=""
                                alt="">
                        </div>
                    </div>

                        <div class="d-flex justify-content-center gap-2 ">
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
