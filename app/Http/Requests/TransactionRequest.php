<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
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
            'date'   => 'required',
            'reason' => 'required',
            'debit'  => 'required_without:credit',
        ];
    }

    public function messages()
    {
        return [
            'reason.required'       => 'The transaction type field is required',
            'debit.required_unless' => 'You must enter a value for either a debit or credit'
        ];
    }
}
