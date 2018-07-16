@extends('layouts.main')

@section('title')
    Edit Transaction
@endsection

@section('content')
    <div class="container">
        <h2 class="title">{{ $resident->last_name }}, {{ $resident->first_name }}</h2>
        @include('partials.editTransactionForm')
    </div>
@endsection
@section('scripts.footer')
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.15/sorting/datetime-moment.js"></script>
    <script>
        $(document).ready(function () {
            var date = "{!! $transaction->date !!}";
            $.fn.dataTable.moment( 'MMMM D, YYYY' );

            $("#debit").maskMoney({
                'prefix': '$',
                'allowZero': true,
            });
            $("#credit").maskMoney({
                'prefix': '$',
                'allowZero': true,
            });
            $("#debit").maskMoney('mask');
            $("#credit").maskMoney('mask');
            $('.table').DataTable();
            $("#edit_transaction_date_calendar").flatpickr({
                defaultDate: date
            });
        });
    </script>
@endsection
