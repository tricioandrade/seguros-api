<?php

namespace App\Http\Requests\Insurance\Claim;

use Illuminate\Foundation\Http\FormRequest;

class ClaimPhotosRequest extends FormRequest
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
        return [
            'client_id'     => 'required|integer|exists:clients,id',
            'photo'         => 'required|file|mimes:jpg,png,jpeg',
            'description'   => 'required|string|max:250'
        ];
    }
}
