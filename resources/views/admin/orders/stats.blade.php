@extends('layouts.admin')

@section('content')
    @php
        $italianMonths = [
            1 => 'Gennaio',
            2 => 'Febbraio',
            3 => 'Marzo',
            4 => 'Aprile',
            5 => 'Maggio',
            6 => 'Giugno',
            7 => 'Luglio',
            8 => 'Agosto',
            9 => 'Settembre',
            10 => 'Ottobre',
            11 => 'Novembre',
            12 => 'Dicembre',
        ];
    @endphp

    <div class="mx-5 card-body">
        @if (!$selectedYear)
            <h3 class="info my-2">Seleziona un anno</h3>
            <form class="form d-flex flex-column w-50 mx-auto" method="GET"
                action="{{ route('admin.order.stats', ['restaurant_id' => $restaurant_id]) }}">
                @csrf

                {{-- Seleziona Mese --}}

                {{-- <div class="form-group">
                    <label class="info col-md-4 col-form-label" for="month">Mese:</label>
                    <select name="month" id="month" class="form-control col-md-4">
                        <option value="">Tutti</option>
                        @foreach ($italianMonths as $monthNumber => $monthName)
                            <option value="{{ $monthNumber }}" {{ $selectedMonth == $monthNumber ? 'selected' : '' }}>
                                {{ $monthName }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}

                {{-- Seleziona Anno --}}

                <div class="form-group">
                    <label class="info col-md-4 col-form-label" for="year">Anno:</label>
                    <select name="year" id="year" class="form-control col-md-4">
                        <option value="">Tutti</option>
                        @php
                            $currentYear = date('Y');
                            $startYear = 2023;
                        @endphp
                        @for ($year = $currentYear; $year >= $startYear; $year--)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class=" my-3 btn btn-primary">Filtra</button>
                </div>
            </form>
        @else
            <div class="d-flex justify-content-evenly my-4">

                <h2 class="info">Statistiche per l'anno {{ $selectedYear }}</h2>
                <a class="btn btn-info" href="{{ route('admin.order.stats', ['restaurant_id' => $restaurant_id]) }}">Torna
                    indietro</a>
            </div>



            {{-- Statistiche tabellari --}}
            {{-- <section>

        @if (!empty($monthlyStats))
            <h2 class="info my-4">Statistiche mensili</h2>
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th>Mese</th>
                        <th>Numero di ordini</th>
                        <th>Totale ricavo €</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($monthlyStats as $month => $stats)
                        <tr>
                            <td>{{ $italianMonths[$month] }}</td>
                            <td>{{ $stats['order_count'] }}</td>
                            <td>{{ $stats['total_sales'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center info">Non ci sono statistiche per il mese/anno selezionato</h3>
        @endif

        @if (!empty($yearlyStats))
            <h2 class="info my-4">Statistiche annuali</h2>
            <table class="table table-hover table-dark">

                <thead>
                    <tr>
                        <th>Anno</th>
                        <th>Numero di ordini</th>
                        <th>Totale vendite €</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($yearlyStats as $year => $stats)
                        <tr>
                            <td>{{ $year }}</td>
                            <td>{{ $stats['order_count'] }}</td>
                            <td>{{ $stats['total_sales'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h3 class="text-center info">Non ci sono statistiche per il mese/anno selezionato</h3>
        @endif
    </section> --}}

            <canvas id="monthlyChart"></canvas>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let monthlyStats = @json($monthlyStats);
                    let italianMonths = @json($italianMonths);
                    let totalSalesData = Object.values(monthlyStats).map(function(monthData) {
                        return monthData.total_sales;
                    });

                    let monthLabels = Object.values(italianMonths);
                    let orderCountData = Array.from({
                        length: 12
                    }, function(_, index) {
                        let month = index + 1;
                        return monthlyStats[month] ? monthlyStats[month].order_count : 0;
                    });
                    let totalSalesData = Array.from({
                        length: 12
                    }, function(_, index) {
                        let month = index + 1;
                        return monthlyStats[month] ? monthlyStats[month].total_sales : 0;
                    });


                    let ctx = document.getElementById('monthlyChart').getContext('2d');
                    let chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: monthLabels,
                            datasets: [{
                                    label: 'Ricavi €',
                                    data: totalSalesData,
                                    // type: 'line',
                                    fill: false,
                                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1,
                                    yAxisID: 'y-axis-revenue'
                                },
                                {
                                    label: 'Numero di ordini',
                                    data: orderCountData,
                                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                    yAxisID: 'y-axis-orders'
                                }
                            ]
                        },
                        options: {
                            scales: {
                                x: {
                                    type: 'category',
                                    title: {
                                        display: true,
                                        text: 'Mese',
                                        color: 'white'
                                    },
                                    ticks: {
                                        color: 'white'
                                    }
                                },
                                'y-axis-orders': {
                                    beginAtZero: true,
                                    position: 'right',
                                    title: {
                                        display: true,
                                        text: 'Numero di ordini',
                                        color: 'white'
                                    },
                                    ticks: {
                                        color: 'white'
                                    }
                                },
                                'y-axis-revenue': {
                                    beginAtZero: true,
                                    position: 'left',
                                    title: {
                                        display: true,
                                        text: 'Ricavi (€)',
                                        color: 'white'
                                    },
                                    ticks: {
                                        color: 'white',
                                        callback: function(value, index, values) {
                                            return value.toFixed(2) + ' €';
                                        }
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        color: 'white'
                                    }
                                }
                            }
                        }
                    });


                });
            </script>
        @endif


    </div>
    <div class="my-5">

    </div>
@endsection
