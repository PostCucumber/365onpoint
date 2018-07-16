@extends('layouts.reports')

@section('title')
    Transaction Report
@endsection

@section('downloadButton')
    <button class="button is-warning" onClick="window.print()">Print</button>
@endsection

@section('content')
    <div class="column wide-table">
        <table class="table transaction-table">
            <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Date</th>
                <th>Reason</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Total Balance:</th>
            </tr>
            </thead>
            <tbody>
            @foreach($residents as $resident)
                @foreach($resident->transactions as $transaction)
                    <tr class="has-text-centered">
                        <td>{{ $transaction->id }}</td>
                        <td><a href="/resident/{{ $transaction->resident_id }}"
                               class="blackish">{{ App\Resident::find($transaction->resident_id)->last_name }}</a></td>
                        <td><a href="/resident/{{ $transaction->resident_id }}"
                               class="blackish">{{ App\Resident::find($transaction->resident_id)->first_name }}</a></td>
                        <td>{{ $transaction->date }}</td>
                        <td>{{ $transaction->reason }}</td>
                        <td>
                            <span class="debit is-danger"> - ${{ number_format(($transaction->debit / 100), 2, '.', ',') }}</span>
                        </td>
                        <td>
                            <span class="credit is-success"> + ${{ number_format(($transaction->credit / 100), 2, '.', ',') }}</span>
                        </td>
                        @if($loop->last)
                            <td>
                                <p class="title is-4">${{ number_format((App\Resident::totalBalance($transaction->resident_id) / 100), 2, '.', ',') }}</p>
                            </td>
                        @else
                            <td>&nbsp;</td>
                        @endif
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
