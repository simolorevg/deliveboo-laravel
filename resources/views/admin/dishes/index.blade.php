@extends('layouts.app')
@section('content')
    <h1>I Piatti di {{ Auth::user()->name }}</h1>
    <a class="btn btn-danger" href="{{ route('admin.dishes.create')}}"> CREA UN NUOVO PIATTO</a>
    <table>
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nome Piatto</th>
                <th scope="col">Azioni</th>
                {{-- <th scope="col">Actions</th> --}}
            </tr>
        </thead>
        <tbody>


            @foreach ($dish as $item)
                @if ($item->restaurant_id == Auth::user()->id)
                    <tr>
                        <td scope="row">{{ $item->id }}</td>
                        <td scope="row">{{ $item->dish_name }}</td>
                        
                        <td scope="row" class="d-flex">
                            <a class="btn btn-primary mx-1" href="{{ route('admin.dishes.show', $item->slug) }}">
                              VISUALIZZA
                                </a>
                            <a class="btn btn-warning mx-1" href="{{ route('admin.dishes.edit', $item->slug) }}">
                                MODIFICA
                                </a>
                            <form action="{{ route('admin.dishes.destroy', $item->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Vuoi cancellare il piatto? Sei sicuro?')">
                                    Elimina
                                </button>
                            </form> 
                        </td> 
                    </tr>
                @endif
            @endforeach

            <a class="btn btn-warning mx-1" href="{{ route('admin.dashboard', $item->slug) }}">
                TORNA INDIETRO in dashboard daje
            </a>
        </tbody>
    </table>
@endsection