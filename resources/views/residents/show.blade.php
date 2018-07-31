@extends('layouts.main')

@section('title')
    {{ $resident->last_name }}, {{ $resident->first_name }} {{ $resident->middle_initial }}
    <p class="subtitle">
        <small>DOC Number: {{ $resident->document_number }}</small>
    </p>
@endsection

@section('content')
    @if(session()->has('updated'))
        <div class="notification is-success">
            {{ session('updated') }}
        </div>
    @endif
    <div class="container">
        <div class="columns">
            <div class="column padding-40">
                @include('partials.residentInfo')
            </div>
        </div>
        <hr>
        @include('partials.notes')
        <hr>
        @include('partials.transactions')
    </div>
@endsection
@section('scripts.footer')
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.15/sorting/datetime-moment.js"></script>
    <script>
        $(document).ready(function () {
            $.fn.dataTable.moment('MMMM D, YYYY');

            $("#debit").maskMoney({
                'prefix': '$',
                'allowZero': true,
            });
            $("#credit").maskMoney({
                'prefix': '$',
                'allowZero': true,
            });
            $('.table').DataTable();
        });
    </script>
@endsection
