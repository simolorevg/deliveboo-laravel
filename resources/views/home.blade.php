@extends('layouts.app')

@section('content-home')
    <div class="wrapper homepage container text-center ">
        <section class="mx-auto">
            <h1 id="welcome" class="welcome">Benvenuto nel gestionale Ristoratori!</h1>
        </section>
    </div>
@endsection

@section('script')
    @vite(['resources/js/modules/home.js'])
@endsection
