<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacilityInfoRequest extends FormRequest
{
    protected $facility_name;
    protected $per_diem;
    protected $contractor_name;
    protected $street_address;
    protected $fein_number;
    protected $contract_number;
    protected $max_annual_bed_days;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'facility_name'       => 'required',
            'contractor_name'     => 'required',
            'max_annual_bed_days' => 'required|numeric',
            'street_address'      => 'required',
            'fein_number'         => 'required',
            'contract_number'     => 'required',
            'per_diem'            => 'required'
        ];
    }
}
