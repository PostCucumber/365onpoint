@extends('layouts.main')

@section('title')
    Add a new resident
@endsection

@section('content')
    <div class="notification is-primary">
        <p class="subtitle">Fill out the form below to add a new resident. Required fields are marked with an asterisk (
            * ).</p>
    </div>
    @include('partials.createResidentForm')
@endsection
