<?php

namespace App\Http\Requests\Employee;

use App\Enums\User\UserGenderEnum;
use App\Traits\Essentials\EssentialsTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class EmployeeRequest extends FormRequest
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
        $id =  $this->route('employee');

        $inputRules = [
            'name'      => 'required|string|max:255',
            'photo'     => 'nullable|file|mime:jpg,png,jpeg',
            'email'     => 'required|string|email|max:255',
            'birthdate' => 'nullable|date',
            'tin'       => 'required|string',
            'address'   => 'required|string',
            'phone'     => 'required|string',
            'gender'    => ['required', new Enum(UserGenderEnum::class)],
            'hire_date' => 'required|date',
            'salary'    => 'required|numeric',
        ];

        $nullableRules = $this->nullRequestRules($inputRules);

        return match ($this->method()){
            'POST'  => $inputRules,
            'PUT'   => [
                ...$nullableRules,
                'name'  => 'nullable|string|unique:employees,name,'.$id,
                'email' => 'nullable|string|email|unique:employees,email,'.$id,
                'tin'   => 'nullable|string|unique:employees,tin,'.$id,
            ]
        };
    }
}
