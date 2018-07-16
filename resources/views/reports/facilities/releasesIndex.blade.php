@extends('layouts.reports')

@section('title')
    Releases Report
@endsection

@section('downloadButton')
    <button class="button is-warning" onClick="window.print()">Print</button>
@endsection

@section('content')
    <div class="column wide-table">
        <p class="subtitle">Total releases for selected date range: <span class="title">{{ $count }}</span>
        <table class="table">
            <thead>
            <tr>
                <th>Resident ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Actual Release Date</th>
                <th>Status at Discharge</th>
            </tr>
            </thead>
            <tbody>
            @foreach($releases as $release)
                <tr class="has-text-centered">
                    <td>{{ $release->id }}</td>
                    <td><a href="/resident/{{ $release->id }}"
                           class="blackish">{{ $release->last_name }}</a></td>
                    <td><a href="/resident/{{ $release->id }}"
                           class="blackish">{{ $release->first_name }}</a></td>
                    <td>{{ $release->actual_date_of_discharge }}</td>
                    <td>{{ $release->status_at_discharge }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
