<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddressRequest extends FormRequest
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
        $user = $this->user(); // Get the authenticated user

        return [
            'user_id' => [
                'required',
                'exists:users,id', // Ensure the user_id exists in the users table
                Rule::in([$user->id]), // Ensure the user_id matches the authenticated user's id
            ],
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
        ];
    }
}
