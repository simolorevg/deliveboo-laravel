@extends('layouts.admin')
@section('content')

@include('admin.partials.messages')

    <div class="wrapper p-5">

        <h2 class="mb-5">Il ristorante di {{ Auth::user()->name }}</h2>
        <table class="table table-dark table-hover table-striped text-center">
            <thead>
                <tr>
                    {{-- <th scope="col" class="px-3">ID</th> --}}
                    <th scope="col" class="px-3">Nome ristorante</th>
                    <th scope="col" class="px-3">Cucine associate </th>
                    <th scope="col" class="px-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurants as $item)
                    @if ($item->user_id == Auth::user()->id)
                        <tr>
                            {{-- <td scope="row">{{ $item->id }}</td> --}}
                            <td scope="row">{{ $item->restaurant_name }}</td>
                            <td scope="row">
                                @foreach ($item->categories as $category)
                                    {{ $category->category_name }} {{ ($loop->last? '' : ',') }}
                                @endforeach
                            </td>
                            <td scope="row" class="d-flex justify-content-center">
                                <a class="btn btn-success mx-1" href="{{ route('admin.restaurants.show', $item->slug) }}">
                                    Dettagli
                                </a>
                                <a class="btn btn-warning mx-1" href="{{ route('admin.restaurants.edit', $item->slug) }}">
                                    Modifica
                                </a>
                                {{-- <form action="{{ route('admin.restaurants.destroy', $item->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Vuoi cancellare il ristorante? Sei sicuro?')">
                                    Elimina
                                </button>
                            </form> --}}
                            </td>
                        </tr>
                    @endif
                @endforeach

            </tbody>
        </table>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-info">Vai alle categorie</a>
    </div>
    
    
@endsection
