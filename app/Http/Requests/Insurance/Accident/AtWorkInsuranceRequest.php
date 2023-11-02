<?php

namespace App\Http\Requests\Insurance\Accident;

use App\Enums\Insurance\Vehicle\FractionationTypesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class AtWorkInsuranceRequest extends FormRequest
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
            'employees'         => 'required|integer',
            'eac'               => 'required|string',
            'salary'            => 'required|numeric',
            'fractionation'     => ['required', new Enum(FractionationTypesEnum::class)],
            'value'             => 'required|numeric',
        ];
    }
}
