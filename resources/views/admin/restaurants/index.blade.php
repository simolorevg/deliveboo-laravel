@extends('layouts.app')
@section('content')
    <h2 class="mx-5">Il ristorante di {{ Auth::user()->name }}</h2>
    <table class="mx-5">
        <thead>
            <tr>
                <th scope="col" class="px-3">id</th>
                <th scope="col" class="px-3">Nome ristorante</th>
                <th scope="col" class="px-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($restaurant as $item)
                @if ($item->user_id == Auth::user()->id)
                    <tr>
                        <td scope="row" class="px-3">{{ $item->id }}</td>
                        <td scope="row" class="px-3">{{ $item->restaurant_name }}</td>
                        <td scope="row" class="d-flex">
                            <a class="btn btn-success mx-1" href="{{ route('admin.restaurants.show', $item->slug) }}">
                                DETTAGLI
                            </a>
                            <a class="btn btn-warning mx-1" href="{{ route('admin.restaurants.edit', $item->slug) }}">
                                MODIFICA
                            </a>
                            <form action="{{ route('admin.restaurants.destroy', $item->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Vuoi cancellare il ristorante? Sei sicuro?')">
                                    Elimina
                                </button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
            <a class="btn btn-warning mx-1" href="{{ route('admin.dashboard') }}">
                TORNA INDIETRO
            </a>
        </tbody>
    </table>
@endsection
