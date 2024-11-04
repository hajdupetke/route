<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\AssignmentStatus;
use Illuminate\Validation\Rule;

class AssignmentUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_address' => 'sometimes|string|max:255',
            'delivery_address' => 'sometimes|string|max:255',
            'recipient_name' => 'sometimes|string|max:100',
            'recipient_phone_number' => 'sometimes|string',
            'status' => ['sometimes', Rule::in(AssignmentStatus::cases())],
            'driver' => 'sometimes|exists:users,id',
        ];
    }
}
