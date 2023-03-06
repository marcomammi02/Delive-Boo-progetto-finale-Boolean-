@php $total = 0; @endphp

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Statistiche</h1>
                <p>Totale ordini: <strong>{{ count($orders) }}</strong></p>
                <p>Totale incassi: <strong>{{ $total }} €</strong></p>
                <div class="row">
                    <div class="col-6">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                    <div class="col-6">
                        <div>
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const datetimes = document.querySelectorAll('.datetime');
        const datetimesValues = Array.from(datetimes).map(datetime => datetime.textContent);
        const dates = datetimesValues.map(datetime => datetime.split(' ')[0]);
        const years = dates.map(date => date.split('-')[0]);
        const months = dates.map(date => date.split('-')[1]);
        const monthsCount = months.reduce((acc, curr) => {
            acc[curr] = acc[curr] ? acc[curr] + 1 : 1;
            return acc;
        }, {});
        const yearsCount = years.reduce((acc, curr) => {
            acc[curr] = acc[curr] ? acc[curr] + 1 : 1;
            return acc;
        }, {});

        const labels = [
            'Gennaio',
            'Febbraio',
            'Marzo',
            'Aprile',
            'Maggio',
            'Giugno',
            'Luglio',
            'Agosto',
            'Settembre',
            'Ottobre',
            'Novembre',
            'Dicembre'
        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Ordini per mese',
                backgroundColor: 'rgb(255, 99, 71)',
                borderColor: 'rgb(255, 99, 132)',
                data: [monthsCount['01'], monthsCount['02'], monthsCount['03'], monthsCount['04'], monthsCount[
                        '05'], monthsCount['06'], monthsCount['07'], monthsCount['08'], monthsCount['09'],
                    monthsCount['10'], monthsCount['11'], monthsCount['12']
                ]
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );

        /* Seconda chart */
        const labels2 = [
            '2020',
            '2021',
            '2022',
        ];

        const data2 = {
            labels: labels2,
            datasets: [{
                label: 'Ordini per anno',
                backgroundColor: 'rgb(229, 72, 80)',
                borderColor: 'rgb(255, 99, 132)',
                data: [yearsCount['2020'], yearsCount['2021'], yearsCount['2022']]
            }]
        };

        const config2 = {
            type: 'bar',
            data: data2,
            options: {}
        };

        const myChart2 = new Chart(
            document.getElementById('myChart2'),
            config2
        );
    </script>
@endsection
