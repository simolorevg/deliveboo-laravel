@extends('layouts.admin')

@section('content')
<h2>Statistiche mese corrente</h2>

@foreach ($monthlyStats as $month => $stat)
    <h3>
        @if (date('F', mktime(0, 0, 0, $month, 1)) == 'July')
        Luglio
        @endif  
    </h3>
    <p>Numero totale degli ordini: {{ $stat['order_count'] }}</p>
    <p>Totale in euro: {{ $stat['total_sales'] }}</p>
@endforeach

<h2>Statistiche annuali degli ordini</h2>

@foreach ($yearlyStats as $year => $stat)
    <h3>{{ $year }}</h3>
    <p>Numero totale degli ordini: {{ $stat['order_count'] }}</p>
    <p>Totale in euro: {{ $stat['total_sales'] }}</p>
@endforeach



@endsection
