@extends('layouts.app')
@section('content')
    <h1>I Piatti di {{ Auth::user()->name }}</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nome Piatto</th>
                {{-- <th scope="col">Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($dish as $item)
                    <tr>
                        <td scope="row">{{ $item->id }}</td>
                        <td scope="row">{{ $item->dish_name }}</td>
                        {{-- <td scope="row" class="d-flex">
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
                        </td> --}}
                    </tr>
            @endforeach
        </tbody>
    </table>
@endsection