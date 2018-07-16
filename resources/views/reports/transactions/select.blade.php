@extends('layouts.main')

@section('title')
    Transaction reports
@endsection

@section('content')
    <div class="container ">
        <div class="columns">
            <div class="column is-full">
                <div class="notification is-default intro">
                    Select the resident, type of transactions, and date range for your report. If you want to run a report
                    everything, just click "Run Report".
                </div>

            </div>
        </div>
    </div>
    <div class="container is-flex trans_select_form">
        <form action="/transaction_report/run" method="post" id="reportForm">
            {{ csrf_field() }}
            <div class="row">
                <div class="field is-horizontal">
                    <div class="column is-4">
                        <div class="field padding-10-lr first">
                            <label class="label">Resident</label>
                            <p class="control">
                    <span class="select is-large">
                        <select id="transaction_resident" name="resident_id">
                            <option value="">All</option>
                            @foreach($residents as $resident)
                                <option value="{{ $resident->id }}">{{ $resident->last_name }}
                                    , {{ $resident->first_name }}</option>
                            @endforeach
                        </select>
                    </span>
                            </p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="column is-6">
                        <div class="field padding-10-lr">
                            <label class="label">Type</label>
                            <p class="control">
                            <div class="columns is-multiline">
                                <label class="checkbox column is-4"><input type="checkbox" class="checkbox is-large"
                                                                           id="checkAll">
                                    All
                                </label>
                                <label class="checkbox column is-4"><input type="checkbox" class="checkbox"
                                                                           name="reason[]"
                                                                           value="Urinalysis">
                                    Urinalysis
                                </label>
                                <label class="checkbox column is-4"><input type="checkbox" class="checkbox"
                                                                           name="reason[]"
                                                                           value="Rides">
                                    Rides
                                </label>
                                <label class="checkbox column is-4"><input type="checkbox" class="checkbox"
                                                                           name="reason[]"
                                                                           value="Physical">
                                    Physical
                                </label>
                                <label class="checkbox column is-4"><input type="checkbox" class="checkbox"
                                                                           name="reason[]"
                                                                           value="Payment">
                                    Payment
                                </label>
                                <label class="checkbox column is-4"><input type="checkbox" class="checkbox"
                                                                           name="reason[]"
                                                                           value="Sustenance">
                                    Sustenance
                                </label>
                            </div>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="columns">
                <div class="column is-2">
                    <div class="field padding-10-lr last">
                        <label class="label">Start Date</label>
                        <p class="control has-icon">
                            <span class="icon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="input" id="transactionPeriodStart" name="start_date" placeholder="YYYY-MM-DD">
                        </p>
                    </div>
                </div>
                <div class="column is-2">
                    <div class="field padding-10-lr last">
                        <label class="label">End Date</label>
                        <p class="control has-icon">
                            <span class="icon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="input" id="transactionPeriodEnd" name="end_date" placeholder="YYYY-MM-DD">
                        </p>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="button is-primary is-large" id="reportSubmit" style="margin-bottom:50px;">Run
                report
            </button>
        </form>
    </div>

@endsection
@section('scripts.footer')
    <script>
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $(document).ready(function () {
            $("#transactionPeriodStart").flatpickr();
            $("#transactionPeriodEnd").flatpickr();
        });
    </script>
@endsection