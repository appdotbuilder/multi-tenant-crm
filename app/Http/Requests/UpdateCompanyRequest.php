<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'email' => 'nullable|email|unique:companies,email,' . $this->route('company')->id,
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string',
            'industry' => 'nullable|string|max:255',
            'employee_count' => 'nullable|integer|min:1',
            'annual_revenue' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,inactive,prospect',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Company name is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already registered to another company.',
            'website.url' => 'Please provide a valid website URL.',
            'employee_count.min' => 'Employee count must be at least 1.',
            'annual_revenue.min' => 'Annual revenue must be a positive number.',
            'status.in' => 'Please select a valid status.',
        ];
    }
}