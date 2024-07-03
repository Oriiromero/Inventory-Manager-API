<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
            $method = $this->method();

            if($method == 'PUT') 
            {
                return [
                    'trackingNumber' => ['required'],
                    'description' => ['required'],
                    'weight' => ['required'],
                    'dimensions' => ['required'],
                    'status' => ['required'],
                    'supermarketId' => ['sometimes','required'],
                ];
            } 
            else 
            {
                return [
                    'trackingNumber' => ['sometimes', 'required'],
                    'description' => ['sometimes', 'required'],
                    'weight' => ['sometimes', 'required'],
                    'dimensions' => ['sometimes', 'required'],
                    'status' => ['sometimes', 'required'],
                    'supermarketId' => ['sometimes', 'required'],
                ];
            }
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
