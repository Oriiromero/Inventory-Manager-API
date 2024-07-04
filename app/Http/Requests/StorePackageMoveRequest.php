<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageMoveRequest extends FormRequest
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
            'status' => ['required'],
            'location' => ['required'],
            'packageId' => ['required'],
            'handledBy' => ['required']
        ];
    }

    protected function prepareForValidation() 
    {
        if($this->packageId)
        {
            $this->merge([
                'package_id' => $this->packageId,
            ]);
        }

        if($this->handledBy)
        {
            $this->merge([
                'handled_by' => $this->handledBy,
            ]);
        }
    }
}
