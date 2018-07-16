@extends('layouts.main')

@section('title')
    Substance Abuse Program Monthly Performance Report
@endsection

@section('content')
    <div class="container">
        @if(! empty(App\FacilityInfo::where('facility_name', \Auth::user()->facility)->first()))
            <div class="columns">
                <div class="column is-full">
                    <div class="notification is-default intro">
                        Select your the month for your report.
                    </div>
                </div>
            </div>
    </div>
    <div class="container is-flex trans_select_form">
        <div class="columns full-width-columns">
            <form action="" method="post" id="invoice-form">
                {{ csrf_field() }}
                <input type="hidden" id="facility" name="facility" value="{{ \Auth::user()->facility }}">
                <div class="column is-5">
                    <div class="field padding-10-lr first">
                        <label class="label">Month</label>
                        <p class="control">
                            <span class="select is-large">
                                <select id="invoice_date" name="date">
                                    @for($i = 1; $i < 15; $i++)
                                        <option value="/{{ Carbon\Carbon::now()->subMonths($i)->year}}/{{ Carbon\Carbon::now()->subMonths($i)->month}}">
                                            {{ Carbon\Carbon::now()->subMonths($i)->format('F, Y') }}
                                        </option>
                                    @endfor
                                </select>
                            </span>
                        </p>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Total Allocation</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                        <p class="control">
                            <input class="input column is-3" type="text" name="totalAllocation">
                        </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Contract Term</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                        <p class="control">
                            <input class="input column is-3" type="text" name="contractTerm">
                        </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Total Previously Paid Out</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                        <p class="control">
                            <input class="input column is-3" type="text" name="totalPaid">
                        </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Balance on Contract Agreement</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                        <p class="control">
                            <input class="input column is-3" type="text" name="balance">
                        </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Percentage of Contract Expended</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                        <p class="control">
                            <input class="input column is-3" type="text" name="expended">
                        </p>
                        </div>
                    </div>
                </div>
                <div class="column is-5">
                    <div class="control">
                        <p class="box">
                            During this invoice period did you utilize any minority/service-disabled veteran vendor?  If yes, please be prepared to attach appropriate documentation.
                            <br />
                            <label class="radio">
                                <input type="radio" name="veteran" value="Yes">
                                Yes
                            </label>
                            <label class="radio">
                                <input type="radio" name="veteran" value="No">
                                No
                            </label>
                            <label class="radio">
                                <input type="radio" name="veteran" value="N/A">
                                N/A
                            </label>
                        </p>
                    </div>
                </div>
                <div class="column is-5">
                    <div class="control">
                        <p class="box">
                            During this invoice period did you purchase all items required to carry out this Contract from PRIDE or RESPECT?  If yes, please attach appropriate documentation.  If no, please provide an explanation.
                            <br />
                            <label class="radio">
                                <input type="radio" name="pride" value="Yes">
                                Yes
                            </label>
                            <label class="radio">
                                <input type="radio" name="pride" value="No">
                                No
                            </label>
                            <label class="radio">
                                <input type="radio" name="pride" value="N/A">
                                N/A
                            </label>
                        </p>
                    </div>
                </div>
                <div class="column is-5">
                    <div class="control">
                        <p class="box">
                            Have you paid all sub-contractors for the previous billing month?
                            <br />
                            <label class="radio">
                                <input type="radio" name="paid" value="Yes">
                                Yes
                            </label>
                            <label class="radio">
                                <input type="radio" name="paid" value="No">
                                No
                            </label>
                            <label class="radio">
                                <input type="radio" name="paid" value="N/A">
                                N/A
                            </label>
                        </p>
                    </div>
                </div>
                <button type="submit" class="button is-primary" id="reportSubmit">Generate Invoice</button>
            </form>
        </div>
        @else
            <div class="container">
                <div class="columns">
                    <div class="column">
                        <div class="notification is-danger">
                            Before you can create an invoice, you have to update your facility information in the
                            "Facility
                            Settings" page on the left.
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts.footer')
    <script>
        $(document).ready(function () {
            $("#invoice_date").select2();
            $('#reportSubmit').on('click', function (e) {
                e.preventDefault();
                var form = $(this).closest('form');
                var facility = $("#facility").val();
                var reportDate = $("#invoice_date").val();
                var veteran = $("input[name='veteran']:checked").val();
                var pride = $("input[name='pride']:checked").val();
                var paid = $("input[name='paid']:checked").val();
                var totalAllocation = parseFloat($("input[name='totalAllocation']").val());
                var contractTerm = $("input[name='contractTerm']").val();
                var totalPaid = parseFloat($("input[name='totalPaid']").val());
                var balance = parseFloat($("input[name='balance']").val());
                var expended = parseFloat($("input[name='expended']").val());
                form.attr('action', '/invoice/' + facility + reportDate + '/?veteran=' + veteran + '&pride=' + pride + '&paid=' + paid + '&totalAllocation=' + totalAllocation + '&contractTerm=' + contractTerm + '&totalPaid=' + totalPaid + '&balance=' + balance + '&expended=' + expended).submit();
                 });
        });
    </script>
@endsection

