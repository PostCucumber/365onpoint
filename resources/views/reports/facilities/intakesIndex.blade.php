@extends('layouts.reports')

@section('title')
    Intakes Report
@endsection

@section('downloadButton')
    <button class="button is-warning" onClick="window.print()">Print</button>
@endsection

@section('content')
    <div class="column wide-table">
        <p class="box subtitle">Total intakes for selected date range:
            <span class="title padding-10-lr">{{ $count }}</span>
        <table class="table">
            <thead>
            <tr>
                <th>Resident ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Admission Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($intakes as $intake)
                <tr class="has-text-centered">
                    <td>{{ $intake->id }}</td>
                    <td><a href="/resident/{{ $intake->id }}"
                           class="blackish">{{ $intake->last_name }}</a></td>
                    <td><a href="/resident/{{ $intake->id }}"
                           class="blackish">{{ $intake->first_name }}</a></td>
                    <td>{{ $intake->date_of_admission }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
