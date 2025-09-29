<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVisitorRequest extends FormRequest
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
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'id_proof' => 'nullable|string|max:100',
            'id_proof_number' => 'nullable|string|max:100',
            'id_proof_img' => 'nullable|url|max:255',
            'photo_url' => 'nullable|string|max:255',
            'purpose' => 'nullable|string|max:500',
            'person_to_meet' => 'nullable|string|max:255',
            'in_time' => 'nullable|date',
            'out_time' => 'nullable|date|after_or_equal:in_time',
            'status' => 'nullable|in:pending,approved,rejected',
            'remarks' => 'nullable|string|max:1000',
        ];
    }
}
