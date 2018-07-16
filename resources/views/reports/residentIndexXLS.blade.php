@extends('layouts.reportsPrintable')

@section('content')
    <div class="column wide-table">
        <table class="table">
            <thead>
            <tr>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Initial</th>
                <th>Email</th>
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
                <th>Status at discharge</th>
                <th>Counselor</th>
                <th>Program Level</th>
            </tr>
            </thead>
            <tbody>
            @foreach($residents as $resident)
                <tr>
                    <td>{{ $resident->last_name }}</td>
                    <td>{{ $resident->first_name }}</td>
                    <td>{{ $resident->middle_initial }}</td>
                    <td>{{ $resident->email }}</td>
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
                    <td>{{ $resident->status_at_discharge }}</td>
                    <td>{{ $resident->counselor }}</td>
                    <td>{{ $resident->program_level }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

