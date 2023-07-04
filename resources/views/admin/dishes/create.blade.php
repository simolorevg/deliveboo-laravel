@extends('layouts.admin')
@section('content')
    <div class="edit mx-auto">

        <h2 class="mx-5">Crea il tuo piatto</h2>
        <div class="mx-5 mt-3">

            <form class="d-flex flex-column form" action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="my-3">
                    <label for="dish_name">Nome Piatto: </label>
                    <input class="mb-3 d-block @error('dish_name') is-invalid @enderror" type="text" name="dish_name"
                        id="dish_name">
                    @error('dish_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="my-3">

                    <label for="description"
                        class="form-label @error('description') is-invalid @enderror">Descrizione</label>
                    <textarea class="form-control" id="description" rows="3" name='description'>
                        {{ old('description') }}
                    </textarea>
                    @error('dish_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="my-3">

                    <label for="ingredients"
                        class="form-label @error('ingredients') is-invalid @enderror">Ingredienti</label>
                    <textarea class="form-control" id="ingredients" rows="2" name='ingredients'>
                        {{ old('ingredients') }}

                    </textarea>
                    @error('ingredients')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <label for="price">Prezzo: € </label>
                <input class="mb-3 @error('price') is-invalid @enderror" type="number" name="price" id="price"
                step="0.01">
                @error('price')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror

                <div class="form-check my-3"> 
                    <input class="form-check-input" type="checkbox"  name="is_available" value="1" {{ $dish->is_available ? '' : 'checked' }} id="is_available">
                    <label class="form-check-label" for="is_available">
                        Terminato
                    </label>
                </div>
                <div class="my-3">
                    <label for="img" class="form-label">Carica Logo</label>
                    <input class="form-control" type="file" id="img">
                </div>
                <div class="button d-flex justify-content-center gap-3">
                    <button type="submit" class="btn btn-primary">Crea</button>
                    <a href="{{ route('admin.dishes.index') }}" class="btn btn-danger">Annulla</a>
                </div>

            </form>
        </div>
    </div>
@endsection
