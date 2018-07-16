@extends('layouts.main')

@section('title')
    {{ \Auth::user()->facility }} Dashboard
@endsection

@section('content')
    @php
        setlocale(LC_MONETARY, 'en_US.UTF-8');
        $residents = App\Resident::where('facility', \Auth::user()->facility);
        $credits   = App\Resident::where('residents.facility', \Auth::user()->facility)
                        ->join('transactions', 'residents.id', '=', 'transactions.resident_id')
                        ->pluck('transactions.credit')->sum();
        $debits    = App\Resident::where('residents.facility', \Auth::user()->facility)
                        ->join('transactions', 'residents.id', '=', 'transactions.resident_id')
                        ->pluck('transactions.debit')->sum();

        $balance = money_format('%.2n', ($credits - $debits) / 100);
    @endphp
    <section class="hero column">
        <!-- Hero content: will be in the middle -->
        <!-- Hero footer: will stick at the bottom -->
        <div class="hero-foot">
            <div class="level">
                <div class="level-item has-text-centered">
                    <div class="column">
                        <p class="heading">Residents</p>
                        <p class="title">{{ $residents->count() }}</p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div class="column">
                        <p class="heading">Current Balance</p>
                        <p class="title">
                            {{ $balance }}
                        </p>
                    </div>
                </div>
                <div class="level-item has-text-centered">
                    <div class="column">
                        <p class="heading">Current Man Days For {{ \Carbon\Carbon::now()->format('F, Y') }}</p>
                        <p class="title">{{ $currentManDays }}</p>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </section>
    <section class="column">
        <div class="columns">
            <div class="column is-offset-1 is-10">
                <p class="subtitle has-text-centered">Man Days</p>
                <canvas id="manDays" width="200" height="50"></canvas>
            </div>
        </div>
        <hr>
        <div class="columns">
            <div class="column is-offset-1 is-4">
                <p class="subtitle has-text-centered">Intakes</p>
                <canvas id="intakes" width="100" height="100"></canvas>
            </div>
            <div class="column is-offset-2 is-4">
                <p class="subtitle has-text-centered">Releases</p>
                <canvas id="releases" width="100" height="100"></canvas>
            </div>
        </div>
    </section>
@endsection
@section('scripts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <script>
        var ctx = document.getElementById("intakes").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    '{{ $intakes[5]['month'] }}',
                    '{{ $intakes[4]['month'] }}',
                    '{{ $intakes[3]['month'] }}',
                    '{{ $intakes[2]['month'] }}',
                    '{{ $intakes[1]['month'] }}',
                    '{{ $intakes[0]['month'] }}',
                ],
                datasets: [{
                    label: '# of intakes',
                    data: [
                        {{ $intakes[5]['count'] }},
                        {{ $intakes[4]['count'] }},
                        {{ $intakes[3]['count'] }},
                        {{ $intakes[2]['count'] }},
                        {{ $intakes[1]['count'] }},
                        {{ $intakes[0]['count'] }},
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById("releases").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    '{{ $releases[5]['month'] }}',
                    '{{ $releases[4]['month'] }}',
                    '{{ $releases[3]['month'] }}',
                    '{{ $releases[2]['month'] }}',
                    '{{ $releases[1]['month'] }}',
                    '{{ $releases[0]['month'] }}',
                ],
                datasets: [{
//                    label: '# of releases',
                    data: [
                        {{ $releases[5]['count'] }},
                        {{ $releases[4]['count'] }},
                        {{ $releases[3]['count'] }},
                        {{ $releases[2]['count'] }},
                        {{ $releases[1]['count'] }},
                        {{ $releases[0]['count'] }},
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById("manDays").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    '{{ $manDays[5]['month'] }}',
                    '{{ $manDays[4]['month'] }}',
                    '{{ $manDays[3]['month'] }}',
                    '{{ $manDays[2]['month'] }}',
                    '{{ $manDays[1]['month'] }}',
                    '{{ $manDays[0]['month'] }}',
                ],
                datasets: [{
//                    label: '# of releases',
                    data: [
                        {{ $manDays[5]['count'] }},
                        {{ $manDays[4]['count'] }},
                        {{ $manDays[3]['count'] }},
                        {{ $manDays[2]['count'] }},
                        {{ $manDays[1]['count'] }},
                        {{ $manDays[0]['count'] }},
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                legend: {
                    display: false
                }
            }
        });
    </script>
@endsection