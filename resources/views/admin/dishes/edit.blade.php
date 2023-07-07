@extends('layouts.admin')

@section('content')
    @include('admin.partials.messages')

    <div class="card container-edit-dish">
        <div class="card-header text-center">
            <h4 class="mx-5">Modifica il tuo piatto: <span class="info">{{ $dish->dish_name }}</span></h4>
        </div>

        <div class="mx-5 card-body">

            <form class="d-flex flex-column form" action="{{ route('admin.dishes.update', $dish->slug) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nome --}}
                <label class="info col-md-4 col-form-label" for="dish_name">Nome Piatto: <span
                        class="need">*</span></label>
                <div class="col-md-6 div-input">
                    <input class="form-label @error('dish_name') is-invalid @enderror" type="text" name="dish_name"
                        id="dish_name" value="{{ old('dish_name', $dish->dish_name) }}" required minlength="3"
                        maxlength="20">
                    @error('dish_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Descrizione --}}
                <div class="mb-3">
                    <label for="description" class="info col-md-4 col-form-label">Descrizione</label>
                    <textarea class="form-control" id="description" rows="3" name='description'>{{ old('description', $dish->description) }}</textarea>
                </div>

                {{-- Ingredienti --}}
                <div class="mb-3">
                    <label for="ingredients" class="info col-md-4 col-form-label">Ingredienti<span
                            class="need">*</span></label>
                    <textarea class="form-control" id="ingredients" rows="2" name='ingredients' required>{{ old('ingredients', $dish->ingredients) }}</textarea>
                </div>

                {{-- Prezzo --}}
                <label class="info col-md-4 col-form-label" for="price">Prezzo: € <span class="need">*</span></label>
                <input class="form-label" type="number" name="price" id="price" step="0.1" min="0"
                    value="{{ old('price', $dish->price) }}" required>

                {{-- Disponibilità --}}
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_available" name="is_available" value="1"
                        {{ $dish->is_available ? '' : 'checked' }}>
                    <label class="form-check-label" for="is_available">
                        Terminato
                    </label>
                </div>


                {{-- Foto --}}
                <div class="my-5 w-50 mx-auto">
                    <label for="image-input" class="form-label">Logo</label>
                    <input type="file" class="form-control" id="image-input" name="img" value="daje">

                    {{-- Se il post ha l'immagine, la visulizzo --}}
                    @if ($dish->img)
                        <div class="my-3 ">
                            <img id="actual-image" width="300" src="{{ asset('storage/' . $dish->img) }}"
                                alt="{{ $dish->dish_name }}">
                        </div>
                    @endif
                    {{-- preview --}}
                    <div class="d-flex justify-content-center my-3">
                        <img width="300" class="d-none" id="image-preview" src="" alt="">
                    </div>
                </div>
                <button type="submit" class="btn mx-auto btn-warning " id="btn-change">Modifica</button>

            </form>
        </div>
    </div>
@endsection


@section('script')
    @vite(['resources/js/modules/editDishes.js'])
@endsection
