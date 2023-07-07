@extends('layouts.admin')

@section('content')
    <section class="d-flex align-items-centes">
        <div class="msg mt-5 py-5">
            <h2 class="message mt-5">Spiacenti, non sei autorizzato.
            </h2>
            <p class="message2 fs-6 mt-5">Stai tentando di accedere ad una pagina per cui non godi dei privilegi da amministratore</p>
        </div>
        <div class="container-403">
            <div class="neon">403</div>
            <div class="door-frame">
                <div class="door">
                    <div class="rectangle">
                    </div>
                    <div class="handle">
                    </div>
                    <div class="window">
                        <div class="eye">
                        </div>
                        <div class="eye eye2">
                        </div>
                        <div class="leaf">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <a class="btn btn-info" href="{{ route('admin.restaurants.index')}}">Torna indietro</a>
@endsection
