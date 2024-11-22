<?php

namespace App\Http\Requests\Users;

use App\Traits\Essentials\EssentialsTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            'is_blocked'=> 'required|boolean',
            'is_admin'  => 'required|boolean',
            'email'     => 'required|string|email|max:255',
            'password'  => ['required', 'confirmed', 'max:255', Password::default()]
        ];

        $nullableRules = $this->nullRequestRules($inputRules);

        return match ($this->method()){
            'POST'  => $inputRules,
            'PUT'   => [
                ...$nullableRules
            ]
        };
    }
}
