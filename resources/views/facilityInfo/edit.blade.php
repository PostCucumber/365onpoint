@extends('layouts.main')

@section('title')
    Update Settings for {{ $facilityInfo->facility_name }}
@endsection

@section('content')
    <div class="container">
        <div class="columns">
            <div class="column is-half padding-40">
                @if(count($errors) > 0)
                    <div id="form-error-box" class="column notification is-danger">
                        <ul id="form-error-list">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('facility-info.update', $facilityInfo->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="facility_name" value="{{ $facilityInfo->facility_name }}">
                    <div class="field">
                        <p class="control">
                            <label class="label">Contractor Name</label>
                            <input type="text" name="contractor_name" class="input"
                                   value="{{ $facilityInfo->contractor_name }}">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label class="label">Address</label>
                            <textarea class="textarea"
                                      name="street_address">{{ $facilityInfo->street_address }}</textarea>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label class="label">FEIN #</label>
                            <input type="text" class="input" name="fein_number"
                                   value="{{ $facilityInfo->fein_number }}">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label class="label">Contract #</label>
                            <input type="text" class="input" name="contract_number"
                                   value="{{ $facilityInfo->contract_number }}">
                        </p>
                    </div>
                    <button type="submit" class="button is-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
