@extends('layouts.admin')

@section('content')

    @if (count($monthlyStats) == 0 && count($yearlyStats) == 0)
        <h3 class="my-5">Spiacenti non ci sono statistiche al momento</h3>
    @else
        <h2 class="info">Statistiche mese corrente</h2>

        @foreach ($monthlyStats as $month => $stat)
            <h3  class="ino">
                @if (date('F', mktime(0, 0, 0, $month, 1)) == 'July')
                   - Luglio
                @endif
            </h3>
            <p>
                <span class="none">Numero totale degli ordini:</span> {{ $stat['order_count'] }}
            </p>
            <p>
                <span class="none">Totale: </span> {{ $stat['total_sales'] }} €
            </p>
        @endforeach

        <h2 class="info">Statistiche annuali degli ordini</h2>

        @foreach ($yearlyStats as $year => $stat)
            <h3 class="inf"> - {{ $year }}</h3>
            <p>
                <span class="none">Numero totale degli ordini:</span> {{ $stat['order_count'] }}
            </p>
            <p>
                <span class="none">Totale: </span> {{ $stat['total_sales'] }} €
            </p>
        @endforeach
    @endif


@endsection
