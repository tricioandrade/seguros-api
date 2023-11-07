<?php

namespace App\Http\Requests\Client\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class VehiclePhotosRequest extends FormRequest
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
            'vehicle_id'    => 'required|exists:vehicles,id',
            'path'          => 'required|file|mimes:jpg,png,jpeg',
            'description'   => 'required|string|max:255'
        ];
    }
}
