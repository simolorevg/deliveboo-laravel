@extends('layouts.admin')
@section('content')
    @include('admin.partials.messages')

    <div class="wrapper p-5">

        <h2>I Piatti del tuo ristorante: <span class="info">{{ Auth::user()->name }}</span></h2>
        {{-- <h3>Piatti totali: <span class="info">{{$dishes->count()}}</span></h3> --}}

        <div class="d-flex justify-content-end">
            <a class="btn btn-info my-4" href="{{ route('admin.dishes.create') }}"> Crea nuovo piatto</a>
        </div>
        @if (count($dishes) === 0)
            <h3 class="none">Spiacenti, non hai aggiunto ancora nessun piatto nel tuo menù, clicca "Crea nuovo piatto" per aggiungerne qualcuno</h3>
        @else
            <table class="table table-dark table-hover table-striped">
                <thead>
                    <tr class="text-center">
                        {{-- <th scope="col">PIATTO ID</th> --}}
                        <th scope="col">NOME PIATTO</th>
                        <th scope="col">RISTORANTE </th>
                        <th scope="col">AZIONI</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($dishes as $item)
                        @if ($item->restaurant_id == Auth::user()->restaurant->id)
                            <tr class="text-center">
                                {{-- <td scope="row">{{ $item->id }}</td> --}}
                                <td scope="row">{{ $item->dish_name }}</td>
                                <td scope="row">{{ $item->restaurant->restaurant_name }}</td>
                                <td scope="row" class="d-flex justify-content-center">
                                    <a class="btn btn-primary mx-1"
                                        href="{{ route('admin.dishes.show', $item->slug) }}">&#128065;</a>
                                    <a class="btn btn-warning mx-1"
                                        href="{{ route('admin.dishes.edit', $item->slug) }}">&#9881;</a>
                                    <form class="d-inline-block" action="{{ route('admin.dishes.destroy', $item->slug) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-delete"
                                            data-dish-name="{{ $item->dish_name }}">&#128465;</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            {{ $dishes->links() }}
        @endif

        @include('admin.partials.modal_delete')
    </div>
@endsection


@section('script')
    @vite(['resources/js/modules/indexDishes.js'])
@endsection
