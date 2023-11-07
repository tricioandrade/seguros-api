<?php

namespace App\Http\Requests\Insurance;

use App\Enums\Insurance\InsuranceTypesEnum;
use App\Enums\Insurance\Vehicle\FractionationTypesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class InsuranceRequest extends FormRequest
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
            'description'       => 'required|string',
            'destiny'           => 'required|integer|exists:travel_destinations, id',
            'duration'          => 'required|integer',
            'vehicle_category'  => 'required|string',
            'cylinder_capacity' => 'required|numeric',
            'employees'         => 'required|integer',
            'eac'               => 'required|string',
            'salary'            => 'required|numeric',
            'type'              => ['required', new Enum(InsuranceTypesEnum::class)],
            'fractionation'     => ['required', new Enum(FractionationTypesEnum::class)],
            'value'             => 'required|numeric',
        ];
    }
}
