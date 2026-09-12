<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $driverId = $this->route('user')->driver?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->route('user'))],
            'password' => ['nullable', 'confirmed', Password::defaults()],
            'rank' => ['required', 'integer', Rule::in([1, 2, 3])],
            'phone' => ['required_if:rank,3', 'nullable', 'string', 'max:255', Rule::unique('drivers', 'phone')->ignore($driverId)],
            'car' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:255'],
        ];
    }
}
