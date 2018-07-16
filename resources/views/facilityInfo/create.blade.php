@extends('layouts.main')

@section('title')
    Settings for {{ $facilityName }}
@endsection

@section('content')
    <div class="container">
        <div class="columns">
            <div class="column is-half padding-40">
                @if(count($errors) > 0)
                    <div id="form-error-box" class="column is-offset-3 is-6 notification is-danger">
                        <ul id="form-error-list">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('facility-info.store') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="facility_name" value="{{ $facilityName }}">
                    <div class="field">
                        <p class="control">
                            <label class="label">Contractor Name</label>
                            <input type="text" name="contractor_name" class="input" value="{{ old('contractor_name') }}">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label class="label">Maximum Annual Bed Days</label>
                            <input type="text" name="max_annual_bed_days" class="input" value="{{ old('max_annual_bed_days') }}">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label class="label">Per Diem Rate for {{ \Auth::user()->facility }}</label>
                            <input type="text" name="per_diem" class="input" id="per_diem" value="{{ old('per_diem') }}">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label class="label">Address</label>
                            <textarea class="textarea" name="street_address">{{ old('street_address') }}</textarea>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label class="label">FEIN #</label>
                            <input type="text" class="input" name="fein_number" value="{{ old('fein_number') }}">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label class="label">Contract #</label>
                            <input type="text" class="input" name="contract_number" value="{{ old('fein_number') }}">
                        </p>
                    </div>
                    <button type="submit" class="button is-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
    <script>
        $("#per_diem").maskMoney({
            'prefix': '$',
        });
    </script>
@endsection
