<?php

namespace App\Http\Requests\Insurance;

use App\Enums\Insurance\Claim\ClaimStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ClaimsRequest extends FormRequest
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
            'policy_id'             => 'required|integer|exists:policies,id',
            'claim_type'            => 'required|string|max:250',
            'description'           => 'required|string',
            'claim_status'          => ['required', new Enum(ClaimStatusEnum::class)],
            'claim_payment'         => 'nullable|numeric',
            'claim_report_date'     => 'required|date',
            'claim_resolution_date' => 'nullable|date'
        ];
    }
}
