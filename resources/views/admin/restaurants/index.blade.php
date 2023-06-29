@extends('layouts.app')
@section('content')
    <h1>index restaurants</h1>
    <table>
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nome ristorante</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($restaurant as $item)
                <tr>
                    <td scope="row">{{ $item->id }}</td>
                    <td scope="row">{{ $item->restaurant_name }}</td>
                    <td scope="row">
                        <a class="btn btn-warning" href="{{ route('admin.restaurants.edit', $item->slug) }}">
                            MODIFICA
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
