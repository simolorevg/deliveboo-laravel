@extends('layouts.admin')
@section('content')
    <div class="container-edit-restaurant card">
        <div class="card-header text-center">
            <h4>Modifica il tuo ristorante: <span class="info">{{ $restaurant->restaurant_name }}</span> </h4>
        </div>
        
        <div class="mx-5 card-body">
            <div class="d-flex mt-3 justify-content-end">
                <a href="{{ route('admin.restaurants.index') }}" class="btn btn-info">Torna indietro</a>
            </div>
            <form method="POST" class="d-flex flex-column form "
                action="{{ route('admin.restaurants.update', $restaurant->slug) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <label class="info col-md-4 col-form-label" for="restaurant_name">Nome Ristorante: <span
                        class="need">*</span></label>
                <div class="col-md-6 div-input">

                    <input class="form-control @error('restaurant_name') is-invalid @enderror" type="text" name="restaurant_name"
                        id="restaurant_name" value="{{ old('restaurant_name', $restaurant->restaurant_name) }}" required
                        minlength="3" maxlength="20">
                    @error('restaurant_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <label class="info col-md-4 col-form-label" for="city">Città: <span class="need">*</span></label>
                <input class="form-control @error('city') is-invalid @enderror" type="text" name="city" id="city"
                    value="{{ old('city', $restaurant->city) }}" required minlength="3" maxlength="20">
                @error('city')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <label class="info col-md-4 col-form-label" for="address">Indirizzo: <span class="need">*</span></label>
                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address"
                    value="{{ old('address', $restaurant->address) }}" required minlength="3" maxlength="20">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <label class="info col-md-4 col-form-label" for="phone">Telefono: <span class="need">*</span></label>
                <input class="form-control @error('phone') is-invalid @enderror" type="number" name="phone" id="phone"
                    value="{{ old('phone', $restaurant->phone) }}" required minlength="9" maxlength="11">
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <label class="info col-md-4 col-form-label" for="closure_day">Giorno di chiusura: </label>
                <input class="form-control @error('closure_day') is-invalid @enderror" type="text" name="closure_day"
                    id="closure_day" value="{{ old('closure_day', $restaurant->closure_day) }}">
                @error('closure_day')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <p class="info col-md-4 col-form-label">Seleziona categorie: <span class="need">*</span></p>
                <p class="error-category d-none">Selezione almeno una categoria </p>
                <div class="btn-group editR mx-auto d-flex flex-wrap gap-2" role="group"
                    aria-label="Basic checkbox toggle button group">
                    @foreach ($categories as $category)
                        <input type="checkbox" class="btn-check edit form-control @error('category_id') is-invalid @enderror"
                            id="{{ $category->category_name }}" autocomplete="off" name="category_id[]"
                            value="{{ $category->id }}" @checked(old('category_id') ? in_array($category->id, old('category_id', [])) : $restaurant->categories->contains($category))>
                        <label class="btn btn-outline-primary" for="{{ $category->category_name }}">
                            {{ $category->category_name }} </label>
                    @endforeach
                    @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                {{-- foto --}}
                    <label for="image-input-editR" class="info col-md-4 my-2 col-form-label ">Logo</label>
                    <input type="file" class="form-control" id="image-input-editR" name="thumb" value="daje">

                    {{-- Se il post ha l'immagine, la visulizzo --}}
                    @if ($restaurant->thumb)
                        <div class="my-3 text-center ">
                            <img id="actual-image-editR" width="300" src="{{ asset('storage/' . $restaurant->thumb) }}"
                                alt="{{ $restaurant->restaurant_name }}">
                        </div>
                    @endif
                    {{-- preview --}}
                    <div class="d-flex justify-content-center my-3">
                        <img class="d-none" width="300" id="image-preview-editR" src="" alt="">
                    </div>

                <button type="submit" class="btn mx-auto btn-warning " id="btn-change">Modifica</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    @vite(['resources/js/modules/editRestaurant.js'])
@endsection

{{-- <style>
    input[type=number] {
        -moz-appearance: textfield;
    }


    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style> --}}
