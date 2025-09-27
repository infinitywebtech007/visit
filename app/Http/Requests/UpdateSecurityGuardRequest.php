<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSecurityGuardRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->route('securityGuard')->user_id, 'id')
            ],
            'phone' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'shift' => 'nullable|string|max:255',
            'photo' => 'nullable|string|max:255',
            'active' => 'nullable|boolean',
        ];
    }
}
