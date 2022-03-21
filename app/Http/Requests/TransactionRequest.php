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
            'employee_id' => ['required'],
            'transaction_type' => ['required'],
            'amount' => ["regex:/^\d+(\.\d{1,2})?$/"],
            'description' => ['required', 'min:5']
        ];
    }
}
