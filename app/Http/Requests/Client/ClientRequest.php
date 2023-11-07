<?php

namespace App\Http\Requests\Client;

use App\Enums\User\UserGenderEnum;
use App\Traits\Essentials\EssentialsTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ClientRequest extends FormRequest
{
    use EssentialsTrait;

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
        $inputRules = [
            'user_id'   => 'required|string',
            'name'      => 'required|string',
            'photo'     => 'nullable|file|mimes:jpg,png,jpeg',
            'email'     => 'required|string|email',
            'birthdate' => 'required|date',
            'tin'       => 'required|string',
            'address'   => 'required|string',
            'phone'     => 'required|string',
            'gender'    => ['required', new Enum(UserGenderEnum::class)],
            'salary'    => 'required|numeric'
        ];

        $nullableRules = $this->nullRequestRules($inputRules);

        return match ($this->method()){
            'POST'  => $inputRules,
            'PUT'   => $nullableRules,
        };
    }
}
