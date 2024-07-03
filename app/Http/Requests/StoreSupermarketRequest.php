<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupermarketRequest extends FormRequest
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
            'name' => ['required'],
            'address' => ['required'],
            'contactEmail' => ['required'],
        ];
    }

    protected function prepareForValidation() 
    {
        if($this->contactEmail)
        {
            $this->merge([
                'contact_email' => $this->contactEmail,
            ]);
        }
    }
}
