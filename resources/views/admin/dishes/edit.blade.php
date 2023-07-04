@extends('layouts.admin')
@section('content')

@include('admin.partials.messages')

    <div class="edit mx-auto">

        <h2 class="mx-5">Modifica il tuo piatto: <span class="info">{{$dish->dish_name}}</span></h2>
        <div class="mx-5">

            <form class="d-flex flex-column form" action="{{ route('admin.dishes.update', $dish->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <label for="dish_name">Nome Piatto: <span class="need">*</span></label>
                <input type="text" name="dish_name" id="dish_name" value="{{ old('dish_name', $dish->dish_name) }}" required>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea class="form-control" id="description" rows="3" name='description'>{{ old('description', $dish->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="ingredients" class="form-label">Ingredienti<span class="need">*</span></label>
                    <textarea class="form-control" id="ingredients" rows="2" name='ingredients' required>{{ old('ingredients', $dish->ingredients) }}</textarea>
                </div>

                <label for="price">Prezzo: € <span class="need">*</span></label>
                <input type="number" name="price" id="price" step="0.1" min="0" value="{{ old('price', $dish->price) }}" required>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_available" name="is_available" value="1" {{ $dish->is_available ? '' : 'checked' }}>
                    <label class="form-check-label" for="is_available">
                        Terminato
                    </label>
                </div>
                
                <div class="mb-3">
                    <label for="img" class="form-label"></label>
                    <input class="form-control" type="file" id="img" value="{{ old('img', $dish->img) }}">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn mx-auto btn-warning">Salva</button>
                    <a href="{{ route('admin.dishes.index') }}" class="btn btn-info">Torna indietro</a>
                </div>

            </form>
        </div>
    </div>
@endsection
