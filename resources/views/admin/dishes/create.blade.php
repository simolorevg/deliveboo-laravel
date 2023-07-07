@extends('layouts.admin')
@section('content')
    <div class="edit card container-create-dish">
        <div class="card-header text-center">
            <h4>Crea il tuo piatto</h4>
        </div>

        <div class="mx-5 card-body">

            <form class="form d-flex flex-column" action="{{ route('admin.dishes.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="d-flex mt-3 justify-content-end">
                    <a href="{{ route('admin.dishes.index') }}" class="btn btn-info">Torna indietro</a>
                </div>
                {{-- Nome --}}

                <label class="info col-md-4 col-form-label" for="dish_name">Nome Piatto: <span class="need">*</span></label>
                <div class="col-md-6 div-input">
                    <input class="form-control @error('dish_name') is-invalid @enderror" type="text" name="dish_name"
                        id="dish_name" required minlength="3" maxlength="20">
                    @error('dish_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Descrizione --}}
                <label class="info col-md-4 col-form-label" for="description"
                    class="form-label @error('description') is-invalid @enderror">Descrizione:
                </label>

                <textarea class="form-control" id="description" rows="3" name='description'>{{ old('description') }}</textarea>
                @error('dish_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <div class="col-md-6 div-input">

                    {{-- Ingredienti --}}
                    <label class="info col-md-4 col-form-label" for="ingredients"
                        class="form-label @error('ingredients') is-invalid @enderror">Ingredienti:
                        <span class="need">*</span></label>
                    <textarea class="form-control" id="ingredients" rows="2" name='ingredients' required>{{ old('ingredients') }}</textarea>
                    @error('ingredients')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Prezzo --}}
                <label class="info col-md-4 col-form-label" for="price">Prezzo: € <span class="need">*</span></label>
                <input class="form-control @error('price') is-invalid @enderror" type="number" name="price"
                    id="price" min="0" step="0.1" required>
                @error('price')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror

                {{-- Disponibilità --}}
                <div class="form-check my-3">
                    <label class="form-check-label info" for="is_available">
                        Visibile
                    </label>
                    <input class="form-check-input" type="checkbox" name="is_available" value="1"
                        {{ $dish->is_available ? '' : 'checked' }} id="is_available">
                </div>

                {{-- immagine --}}
                    <label class="info form-label" for="image-input" class="form-label">Carica immagine</label>
                    <input type="file" class="form-control" id="image-input" name="img">
                    {{-- preview --}}
                    <div class="d-flex justify-content-center my-3">
                        <img class="d-none" width="300" id="image-preview" src="" alt="">
                    </div>

                <div class="button d-flex justify-content-center gap-3">
                    <button type="submit" class="btn btn-primary">Crea</button>
                    <a href="{{ route('admin.dishes.index') }}" class="btn btn-danger">Annulla</a>
                </div>

            </form>
        </div>
    </div>
@endsection


@section('script')
    @vite(['resources/js/modules/createDishes.js'])
@endsection
