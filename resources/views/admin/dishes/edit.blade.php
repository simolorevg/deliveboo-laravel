@extends('layouts.admin')
@section('content')
    @include('admin.partials.messages')

    <div class="edit mx-auto">

        <h2 class="mx-5">Modifica il tuo piatto: <span class="info">{{ $dish->dish_name }}</span></h2>
        <div class="mx-5">

            <form class="d-flex flex-column form" action="{{ route('admin.dishes.update', $dish->slug) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nome --}}
                <label for="dish_name">Nome Piatto: <span class="need">*</span></label>
                <input type="text" name="dish_name" id="dish_name" value="{{ old('dish_name', $dish->dish_name) }}"
                    required>

                {{-- Descrizione --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea class="form-control" id="description" rows="3" name='description'>{{ old('description', $dish->description) }}</textarea>
                </div>

                {{-- Ingredienti --}}
                <div class="mb-3">
                    <label for="ingredients" class="form-label">Ingredienti<span class="need">*</span></label>
                    <textarea class="form-control" id="ingredients" rows="2" name='ingredients' required>{{ old('ingredients', $dish->ingredients) }}</textarea>
                </div>

                {{-- Prezzo --}}
                <label for="price">Prezzo: € <span class="need">*</span></label>
                <input type="number" name="price" id="price" step="0.1" min="0"
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
                    <label for="image-input-dish" class="form-label">Logo</label>
                    <input type="file" class="form-control" id="image-input-dish" name="img" value="daje">

                    {{-- Se il post ha l'immagine, la visulizzo --}}
                    @if ($dish->img)
                        <div class="my-3 ">
                            <img id="actual-image-dish" width="300" src="{{ asset('storage/' . $dish->img) }}"
                                alt="{{ $dish->dish_name }}">
                        </div>
                    @endif
                    {{-- preview --}}
                    <div class="d-flex justify-content-center my-3">
                        <img class="d-none" id="image-preview-dish" src="" alt="">
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
