<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'description' => 'nullable|string',
            'type' => 'required|in:call,email,meeting,follow_up,demo,other',
            'priority' => 'required|in:low,medium,high,urgent',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'due_date' => 'required|date',
            'assigned_to' => 'required|exists:users,id',
            'taskable_type' => 'nullable|string|in:App\\Models\\Contact,App\\Models\\Company,App\\Models\\Deal,App\\Models\\Lead',
            'taskable_id' => 'nullable|integer|required_with:taskable_type',
            'notes' => 'nullable|string',
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
            'title.required' => 'Task title is required.',
            'type.required' => 'Task type is required.',
            'type.in' => 'Please select a valid task type.',
            'priority.required' => 'Task priority is required.',
            'priority.in' => 'Please select a valid priority level.',
            'status.required' => 'Task status is required.',
            'status.in' => 'Please select a valid status.',
            'due_date.required' => 'Due date is required.',
            'assigned_to.required' => 'Please assign this task to a user.',
            'assigned_to.exists' => 'Please select a valid user.',
            'taskable_id.required_with' => 'Please provide a valid related record.',
        ];
    }
}