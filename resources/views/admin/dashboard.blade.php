@extends('layouts.admin')

@section('content')
    <h1 class="text-center my-5">Buongiorno
        <span class="number text-decoration-underline"> {{ Auth::user()->name }}</span>
        {{-- @php
            $user = Auth::user();
            if ($user->restaurant()->exists()) {
                // La relazione esiste
            } else {
                // La relazione non esiste
                return 'crea il tuo ristorante';
            }
        @endphp --}}
    </h1>

    {{-- <form class="w-50 container text-center" method="GET" action="{{ 'admin.'}}">
        @csrf

        <div class="form-group my-3">
            <label for="exampleFormControlInput1">Nome ristorante:</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="inserisci il nome">
        </div>

        <div class="form-group my-3">
            <label for="exampleFormControlInput1">Città:</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="inserisci località">
        </div>

        <div class="form-group my-3">
            <label for="exampleFormControlInput1">CAP:</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="inserisci località">
        </div>

        <div class="form-group my-3">
            <label for="exampleFormControlInput1">Telefono:</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="inserisci telefono">
        </div>

        <div class="form-group my-3">
            <label for="exampleFormControlInput1">Partita IVA:</label>
            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="inserisci partita iva">
        </div>


        <div class="form-group my-3">
            <label for="exampleFormControlTextarea1">Giorno/i di chiusura:</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        {{-- file storage --}}
    {{-- <figure>
            <p>Inserisci logo/immagine </p>
            <img src="{{ Vite::asset('resources/img/bootstrap.png') }}" alt="">
        </figure>

        <div class="form-group">
            <p for="exampleFormControlInput1">Tipologia di cucina:</p>
            <label for="exampleFormControlInput1">Indiano</label>
            <input type="checkbox">
            <label for="exampleFormControlInput1">cinese:</label>
            <input type="checkbox">
            <label for="exampleFormControlInput1">Italiana</label>
            <input type="checkbox">
            <label for="exampleFormControlInput1">Americana</label>
            <input type="checkbox">
        </div>
        
        <button class="btn btn-primary">Salva</button> --}}

    {{--  </form> --}}
@endsection
