<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\AssignmentStatus;
use Illuminate\Validation\Rule;

class AssignmentCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role == UserRole::Admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_address' => 'required|string|max:255',
            'delivery_address' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:100',
            'recipient_phone_number' => 'required|string',
            'status' => ['required', Rule::in(AssignmentStatus::cases())],
            'driver' => 'required|exists:users,id',
        ];
    }

    public function messages() {
        return [
            'max' => __('error.max'),
            'required' => __('error.required')
        ];
    }
}
