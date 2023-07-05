@extends('layouts.admin')

@section('content')
    <h1 class="text-center my-5">Buongiorno<span class="number info"> {{ Auth::user()->name }}</span> </h1>

    <div id="datetime" class=" text-end"></div>
@endsection


@section('script')
    @vite(['resources/js/modules/dashboard.js'])
@endsection