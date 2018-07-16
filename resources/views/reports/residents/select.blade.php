@extends('layouts.main')

@section('title')
    Resident reports
@endsection

@section('content')
    <div class="container">
        <div class="columns">
            <div class="column is-full">
                <div class="notification is-default intro">
                    Select how your would like the Resident report to be sorted.
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="columns">
            <form action="#" method="get" id="sortReportForm">
                <div class="column is-half">
                    {{ csrf_field() }}
                    <div class="field is-horizontal">
                        <div class="field padding-10-lr first sortForm">
                            <label class="label">Sort By</label>
                            <p class="control">
                    <span class="select is-large">
                        <select id="sort_by" name="sort_by">
                            <option value="/report/last-name">Last Name</option>
                            <option value="/report/counselor">Counselor</option>
                            <option value="/report/dob">Date of Birth</option>
                            <option value="/report/admit-date">Date of admission</option>
                            <option value="/report/discharge-date">Date of discharge</option>
                        </select>
                    </span>
                            </p>
                        </div>
                    </div>
                    <button type="submit" class="button is-primary" id="sortReportSubmit">Run report</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts.footer')
    <script>
        $("#sortReportSubmit").on("click", function (e) {
            e.preventDefault();
            var location = $("#sort_by").val();
            $("#sortReportForm").attr('action', location).submit();
        });
    </script>
@endsection
