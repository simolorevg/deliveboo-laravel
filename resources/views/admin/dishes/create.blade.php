@extends('layouts.admin')
@section('content')
    <div class="edit mx-auto">

        <h2 class="mx-5">Crea il tuo piatto</h2>
        <div class="mx-5 mt-3">

            <form class="d-flex flex-column form" action="{{ route('admin.dishes.store') }}" method="POST">
                @csrf
                <label for="dish_name">Nome Piatto: </label>
                <input class="mb-3" type="text" name="dish_name" id="dish_name">

                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea class="form-control" id="description" rows="3" name='description'></textarea>
                </div>

                <div class="mb-3">
                    <label for="ingredients" class="form-label">Ingredienti</label>
                    <textarea class="form-control" id="ingredients" rows="2" name='ingredients'></textarea>
                </div>

                <label for="price">Prezzo: € </label>
                <input class="mb-3" type="number" name="price" id="price" step="0.01">

                <div class="form-check"> <input class="form-check-input" type="checkbox" value="1" id="is_available">
                    <label class="form-check-label" for="is_available">
                        Terminato
                    </label>
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label"></label>
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
