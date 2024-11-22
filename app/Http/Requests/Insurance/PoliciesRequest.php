<?php

namespace App\Http\Requests\Insurance;

use App\Enums\Insurance\Policie\PoliceStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class PoliciesRequest extends FormRequest
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
            'client_id'         => 'required|integer|exists:clients,id',
            'vehicle_id'        => 'nullable|integer|exists:vehicles,id',
            'insurance_id'      => 'required|integer|exists:insurance,id',
            'issue_date'        => 'required|date',
            'expiration_date'   => 'required|date',
            'status'            => ['required', new Enum(PoliceStatusEnum::class)],
            'policy_holder'     => 'required|string',
            'renewal_date'      => 'required|date',
            'policy_terms'      => 'required|string',
        ];
    }
}
