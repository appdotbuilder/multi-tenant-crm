<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:contacts,email,' . $this->route('contact')->id,
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'job_title' => 'nullable|string|max:255',
            'company_id' => 'nullable|exists:companies,id',
            'address' => 'nullable|string',
            'birthday' => 'nullable|date',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,inactive,lead',
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
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already registered to another contact.',
            'company_id.exists' => 'Please select a valid company.',
            'birthday.date' => 'Please provide a valid birthday.',
            'status.in' => 'Please select a valid status.',
        ];
    }
}