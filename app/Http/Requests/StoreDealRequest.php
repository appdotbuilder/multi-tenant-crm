<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDealRequest extends FormRequest
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
            'value' => 'required|numeric|min:0',
            'company_id' => 'nullable|exists:companies,id',
            'contact_id' => 'nullable|exists:contacts,id',
            'stage' => 'required|in:prospecting,qualification,proposal,negotiation,closed_won,closed_lost',
            'probability' => 'required|integer|min:0|max:100',
            'expected_close_date' => 'required|date|after_or_equal:today',
            'description' => 'nullable|string',
            'assigned_to' => 'nullable|exists:users,id',
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
            'name.required' => 'Deal name is required.',
            'value.required' => 'Deal value is required.',
            'value.min' => 'Deal value must be a positive number.',
            'company_id.exists' => 'Please select a valid company.',
            'contact_id.exists' => 'Please select a valid contact.',
            'stage.required' => 'Deal stage is required.',
            'stage.in' => 'Please select a valid deal stage.',
            'probability.required' => 'Probability is required.',
            'probability.min' => 'Probability must be between 0 and 100.',
            'probability.max' => 'Probability must be between 0 and 100.',
            'expected_close_date.required' => 'Expected close date is required.',
            'expected_close_date.after_or_equal' => 'Expected close date cannot be in the past.',
            'assigned_to.exists' => 'Please select a valid user.',
        ];
    }
}