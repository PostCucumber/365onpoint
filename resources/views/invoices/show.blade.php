@extends('layouts.invoice')

@section('title')
    Substance Abuse Residential Program Monthly Performance Report - {{ $invoiceMonth }}
@endsection

@section('downloadButton')
    <form action="" method="post">
        {{ csrf_field() }}
        <input type="hidden" id="facility" name="facility" value="{{ $facilityInfo->facility_name }}">
        <input type="hidden" id="year" name="year" value="{{ $year }}">
        <input type="hidden" id="month" name="month" value="{{ $month }}">
        <input type="hidden" id="veteran" value="{{ $veteran }}">
        <input type="hidden" id="pride" value="{{ $pride }}">
        <input type="hidden" id="paid" value="{{ $paid }}">
        <input type="hidden" id="totalAllocation" value="{{ $totalAllocation }}">
        <input type="hidden" id="contractTerm" value="{{ $contractTerm }}">
        <input type="hidden" id="totalPaid" value="{{ $totalPaid }}">
        <input type="hidden" id="balance" value="{{ $balance }}">
        <input type="hidden" id="expended" value="{{ $expended }}">
    <button class="button is-warning" id="reportSubmit">Printable Version</button>
    </form>
@endsection

@section('content')
    <div class="column invoice-table">
        <div class="columns page-break">
            <div class="column" style="margin-top:30px;">
                <table class="table is-striped is-bordered">
                    <tr>
                        <td><strong>Contractor Name</strong></td>
                        <td>{{ $facilityInfo->contractor_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Mailing Address</strong></td>
                        <td>{!! nl2br($facilityInfo->street_address) !!}</td>
                    </tr>
                    <tr>
                        <td><strong>FEIN#:</strong></td>
                        <td>{{ $facilityInfo->fein_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>Contract Number</strong></td>
                        <td>{{ $facilityInfo->contract_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>Invoice #:</strong></td>
                        <td>{{ $invoiceNumber }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total days in month:</strong></td>
                        <td>{{ \Carbon\Carbon::create($year, $month)->daysInMonth }}</td>
                    </tr>
                    <tr>
                        <td><strong>Maximum annualized bed days</strong></td>
                        <td>{{ $facilityInfo->max_annual_bed_days }}</td>
                    </tr>
                    <tr>
                        <td><strong>*Cumulative Bed Days Used Fiscal Year-to-Date (through last day of prior billing month):<strong></td>
                        <td>{{ $manDaysFY }}</td>
                    </tr>
                    <tr>
                        <td><strong>Occupied bed days for billing month</strong></td>
                        <td>{{ $totalBedDaysForMonth }}</td>
                    </tr>
                    <tr>
                        <td><strong>Per Diem Billing Rate</strong></td>
                        <td>${{ $facilityInfo->per_diem }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td>
                            ${{ number_format($facilityInfo->per_diem * $totalBedDaysForMonth , 2, '.', ',') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <table class="table is-striped is-bordered" style="margin-bottom:-10px;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>DC#</th>
                        <th>Offender Name</th>
                        <th>Entry Date</th>
                        <th>ERC Entry Date</th>
                        <th>Exit Date</th>
                        <th>Discharge Code</th>
                        <th>Bed Days</th>
                        <th>Total Per Diem</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($residents as $resident)
                        <tr class="has-text-centered">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $resident->document_number }}</td>
                            <td>{{ $resident->last_name }}, {{ $resident->first_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($resident->date_of_admission)->format('m-d-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($resident->date_of_admission)->addMonths(2)->format('m-d-Y') }}</td>
                            <td>
                                @if(
                                    $resident->actual_date_of_discharge != null &&
                                    \Carbon\Carbon::parse($resident->actual_date_of_discharge)->lessThanOrEqualTo(
                                        \Carbon\Carbon::createFromDate($year, $month)->endOfMonth()))
                                {{ \Carbon\Carbon::parse($resident->actual_date_of_discharge)->format('m-d-Y') }}
                                @endif
                            </td>
                            <td>
                                @if($resident->status_at_discharge == 'Administrative')
                                    A
                                @elseif($resident->status_at_discharge == 'Successful')
                                    S
                                @elseif(preg_match('/Unsuccessful*/', $resident->status_at_discharge))
                                    U
                                @endif
                            </td>
                            <td>{{ App\Resident::calculateManDaysForMonth($year, $month, $resident) }}</td>
                            <td>
                                ${{ number_format($facilityInfo->per_diem * App\Resident::calculateManDaysForMonth($year, $month, $resident), 2, '.', ',') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts.footer')
    <script>
        $(document).ready(function () {
            $('#reportSubmit').on('click', function (e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var facility = $("#facility").val();
                var year = $("#year").val();
                var month = $("#month").val();
                var veteran = $("#veteran").val();
                var pride = $("#pride").val();
                var paid = $("#paid").val();
                var totalAllocation = $("#totalAllocation").val();
                console.log(totalAllocation);
                var contractTerm = $("#contractTerm").val();
                var totalPaid = $("#totalPaid").val();
                var balance = $("#balance").val();
                var expended = $("#expended").val();
                form.attr('action', '/printable/' + facility + '/' + year + '/' + month + '?veteran=' + veteran  + '&pride=' + pride  + '&paid=' + paid + '&totalAllocation=' + totalAllocation + '&contractTerm=' + contractTerm + '&totalPaid=' + totalPaid + '&balance=' + balance + '&expended=' + expended).submit();
            });
        });
    </script>
@endsection
