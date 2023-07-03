@extends('layouts.admin')

@section('content')
    <h2>Categorie disponibili: <span class="info"> {{count($categories)}} </span></h2>

    <div class="row">
        <div class="col-6">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"> name</th>
                        <th scope="col">icon</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td scope="row">{{ $category->category_name }}</td>
                            <td scope="row">
                                <img width="80px" src='{{ $category->icon }}' alt="">
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
