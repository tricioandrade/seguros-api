<?php

namespace App\Http\Requests\Client\Vehicle;

use App\Enums\Client\Vehicle\FuelTypeEnum;
use App\Enums\Client\Vehicle\OwnershipStatusEnum;
use App\Enums\Client\Vehicle\VehicleConditionEnum;
use App\Enums\Client\Vehicle\VehicleTransmissionTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class VehicleRequest extends FormRequest
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
            'client_id'             => 'required|integer|exists:clients,id',
            'license_plate'         => 'required|string',
            'manufacturer'          => 'required|string',
            'model'                 => 'required|string',
            'color'                 => 'required|string',
            'cylinder_capacity'     => 'required|string',
            'vin'                   => 'required|string',
            'fuel_type'             => ['required', new Enum(FuelTypeEnum::class)],
            'transmission_type'     => ['required', new Enum(VehicleTransmissionTypeEnum::class)],
            'ownership_status'      => ['required', new Enum(OwnershipStatusEnum::class)],
            'vehicle_condition'     => ['required', new Enum(VehicleConditionEnum::class)],
            'seating_capacity'      => 'required|integer',
            'odometer_reading'      => 'required|integer',
            'manufacturing_year'    => 'required|string',
            'registration_date'     => 'required|string',
            'registration_number'   => 'required|string',
            'vehicle_value'         => 'required|numeric',
            '',
        ];
    }
}
