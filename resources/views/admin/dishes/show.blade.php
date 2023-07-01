@extends('layouts.admin')
@section('content')
    <h2 class="text-center">{{ $dish->dish_name }}</h2>
    <ul class="list-unstyled">
        <li>{{$dish->price}}</li>
        <li>{{$dish->description}}</li>
        <li>{{$dish->ingredients}}</li>
    </ul>
@endsection