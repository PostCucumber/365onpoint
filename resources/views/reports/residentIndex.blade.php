@extends('layouts.reports')

@section('title')
    Report sorted by {{ $sortType }}
@endsection

@section('downloadButton')
    <a href="{{ $downloadLink }}" class="button is-primary">Download to Excel</a>
    <button class="button is-warning" onClick="window.print()">Print</button>
@endsection

@section('content')
    <style type="text/css">
        table { page-break-inside:auto }
        tr    { page-break-inside:avoid; page-break-after:auto }
        thead { display:table-header-group }
        tfoot { display:table-footer-group }
    </style>
    <div class="column wide-table">
        <table class="table">
            <thead>
            <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Sex</th>
                <th>Race</th>
                <th>Document Number</th>
                <th>SC #</th>
                <th>DOB</th>
                <th>Age</th>
                <th>Drug of Choice</th>
                <th>Date of Admission</th>
                <th>Projected Date of Discharge</th>
                <th>Actual Discharge</th>
                <th>Status</th>
                <th>Counselor</th>
            </tr>
            </thead>
            <tbody>
            @foreach($residents as $resident)
                <tr class="has-text-centered">
                    <td><a href="/resident/{{ $resident->id }}" class="blackish">{{ $resident->last_name }}</a></td>
                    <td>{{ $resident->first_name }}</td>
                    <td>{{ $resident->sex }}</td>
                    <td>{{ $resident->race }}</td>
                    <td>{{ $resident->document_number }}</td>
                    <td>{{ $resident->service_center_number }}</td>
                    <td>{{ $resident->dob }}</td>
                    <td>{{ $resident->age }}</td>
                    <td>{{ $resident->drug }}</td>
                    <td>{{ $resident->date_of_admission }}</td>
                    <td>{{ $resident->projected_date_of_discharge }}</td>
                    <td>{{ $resident->actual_date_of_discharge }}</td>
                    <td>{{ $resident->status }}</td>
                    <td>{{ $resident->counselor }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

