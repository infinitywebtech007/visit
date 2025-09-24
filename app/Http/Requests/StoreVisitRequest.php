<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisitRequest extends FormRequest
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
            'visitor_id' => 'nullable',
            'visitor_mobile' => 'nullable',

            'employee_id' => 'nullable',
            'purpose' => 'nullable|string|max:20',
            'HOD' => 'nullable|string|max:500',
            'prebooked' => 'nullable',
            'visit_date' => 'nullable|date',
        ];
    }
}
