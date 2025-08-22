<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeadRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email,' . $this->route('lead')->id,
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'source' => 'required|in:website,referral,social_media,cold_call,email_campaign,other',
            'status' => 'required|in:new,contacted,qualified,proposal,negotiation,won,lost',
            'estimated_value' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
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
            'title.required' => 'Lead title is required.',
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already registered as a lead.',
            'source.required' => 'Lead source is required.',
            'source.in' => 'Please select a valid lead source.',
            'status.required' => 'Lead status is required.',
            'status.in' => 'Please select a valid lead status.',
            'estimated_value.min' => 'Estimated value must be a positive number.',
            'assigned_to.exists' => 'Please select a valid user.',
        ];
    }
}