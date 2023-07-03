@extends('layouts.admin')
@section('content')

<div class="wrapper p-5">
    <h2>I Piatti del tuo ristorante: <span class="info">{{ Auth::user()->name }}</span></h2>
    
    {{-- <h3>Piatti totali: <span class="info">{{count($item )}}</span></h3> --}}


    <div class="d-flex justify-content-end">
        <a class="btn btn-info my-4" href="{{ route('admin.dishes.create') }}"> Crea nuovo piatto</a>
    </div>
    <table class="table table-dark table-hover table-striped">
        <thead>
            <tr class="text-center">
                <th scope="col">PIATTO ID</th>
                <th scope="col">NOME PIATTO</th>
                <th scope="col">RISTORANTE ID</th>
                <th scope="col">AZIONI</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($dish as $item)
                @if ($item->restaurant_id == Auth::user()->id)
                    <tr class="text-center">
                        <td scope="row">{{ $item->id }}</td>
                        <td scope="row">{{ $item->dish_name }}</td>
                        <td scope="row">{{ $item->restaurant_id }}</td>
                        <td scope="row" class="d-flex justify-content-center">
                            <a class="btn btn-primary mx-1" href="{{ route('admin.dishes.show', $item->slug) }}">Visualizza</a>
                            <a class="btn btn-warning mx-1" href="{{ route('admin.dishes.edit', $item->slug) }}">Modifica</a>
                            <form class="d-inline-block" action="{{ route('admin.dishes.destroy', $item->slug) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Vuoi cancellare il piatto? Sei sicuro?')">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

@endsection
