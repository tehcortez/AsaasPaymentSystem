<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCobrancaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'billing_type' => ['required', 'string', 'in:BOLETO,PIX,CREDIT_CARD'],
            'value' => ['required', 'numeric', 'min:0.01', 'max:99999.99'],
            'due_date' => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:now'],
            'holderName' => ['string', 'max:255'],
            'number' => ['required_if:billing_type,==,CREDIT_CARD', 'regex:/^([0-9]*)$/'],
            'expiryMonth' => ['required_if:billing_type,==,CREDIT_CARD', 'numeric', 'max:12', 'min:1'],
            'expiryYear' => ['required_if:billing_type,==,CREDIT_CARD', 'numeric', 'max:2254', 'min:2024'],
            'ccv' => ['required_if:billing_type,==,CREDIT_CARD', 'numeric', 'max:9999', 'min:001'],
            'name' => ['required_if:billing_type,==,CREDIT_CARD'],
            'email' => ['required_if:billing_type,==,CREDIT_CARD'],
            'cpfCnpj' => ['required_if:billing_type,==,CREDIT_CARD'],
            'postalCode' => ['required_if:billing_type,==,CREDIT_CARD'],
            'addressNumber' => ['required_if:billing_type,==,CREDIT_CARD'],
            'addressComplement' => ['required_if:billing_type,==,CREDIT_CARD'],
            'phone' => ['required_if:billing_type,==,CREDIT_CARD'],
        ];
    }
}
