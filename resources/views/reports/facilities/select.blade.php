@extends('layouts.main')

@section('title')
    Select facility reports
@endsection

@section('content')
    <div class="container">
        <div class="columns">
            <div class="column is-full">
                <div class="notification is-default intro">
                    Select your facility report.
                </div>
            </div>
        </div>
    </div>
    <div class="container is-flex trans_select_form">
        <div class="columns full-width-columns">
            <form action="{{ route('determine_facility_report') }}" method="get" id="intakeForm">
                {{ csrf_field() }}
                <input type="hidden" name="facility" value="{{ \Auth::user()->facility }}">
                <div class="field is-horizontal">
                    <div class="column is-5">
                        <div class="field padding-10-lr first">
                            <label class="label">Type of Report</label>
                            <p class="control">
                    <span class="select is-large">
                        <select id="sort_by" name="report" required>
                            <option value="">Select report</option>
                            <option value="intakes">Intakes</option>
                            <option value="releases">Releases</option>
                            {{--<option value="man days">Man Days</option>--}}
                        </select>
                    </span>
                            </p>
                        </div>
                    </div>
                    <div class="column is-5">
                        <div class="field padding-10-lr first">
                            <label class="label">Month</label>
                            <p class="control">
                        <span class="select is-large">
                        <select id="transaction_date" name="date">
                            <option value="year_to_date">Year to date</option>
                            @for($i = 0; $i < 14; $i++)
                                <option value="{{ Carbon\Carbon::now()->subMonths($i)->toDateString() }}">
                                    {{ Carbon\Carbon::now()->subMonths($i)->format('F, Y') }}
                                </option>
                            @endfor
                        </select>
                    </span>
                            </p>
                        </div>
                    </div>
                </div>
                <button type="submit" class="button is-primary" id="sortReportSubmit">Run report</button>
            </form>
        </div>
    </div>
@endsection
