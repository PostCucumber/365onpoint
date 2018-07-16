@extends('layouts.main')

@section('title')
    Edit records for {{ $resident->last_name }}, {{ $resident->first_name }}
@endsection

@section('content')
    @include('partials.editResidentForm')
@endsection
