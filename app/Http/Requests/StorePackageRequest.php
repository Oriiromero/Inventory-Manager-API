<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        #TODO: turn this to false when the auth by user is completed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        return [
           'trackingNumber' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:250'],
            'weight' => ['required', 'numeric'],
            'dimensions' => ['required', 'string', 'max:50'],
            'status' => ['required', 'string'],
            'supermarketId' => ['sometimes', 'required', 'exists:supermarkets,id'],
        ];
    }

    protected function prepareForValidation() 
    {
        if($this->trackingNumber)
        {
            $this->merge([
                'tracking_number' => $this->trackingNumber,
            ]);
        }

        if($this->supermarketId)
        {
            $this->merge([
                'supermarket_id' => $this->supermarketId,
            ]);
        }
    }
}
